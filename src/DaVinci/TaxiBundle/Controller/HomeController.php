<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use DaVinci\TaxiBundle\Controller\StepsController;

use DaVinci\TaxiBundle\Form\Payment\MakePaymentFlow;

use DaVinci\TaxiBundle\Entity\Payment\MakePayment;
use DaVinci\TaxiBundle\Entity\Payment\MakePaymentService;
use DaVinci\TaxiBundle\Entity\Payment\PaymentMethod;
use DaVinci\TaxiBundle\Entity\Payment\CreditCardPaymentMethod;
use DaVinci\TaxiBundle\Entity\Payment\InternalPaymentMethod;
use DaVinci\TaxiBundle\Entity\Payment\MakePayments;

use DaVinci\TaxiBundle\Entity\VehicleClasses;
use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\PassengerRequestRepository;
use DaVinci\TaxiBundle\Entity\PassengerRequestService;
use DaVinci\TaxiBundle\Entity\IndependentDriverRepository;

use DaVinci\TaxiBundle\Event\PassengerRequestEvents;
use DaVinci\TaxiBundle\Event\CancelRequestEvent;
use DaVinci\TaxiBundle\Event\CommonDriverRequestEvent;
use DaVinci\TaxiBundle\Event\FinancialOfficeEvents;
use DaVinci\TaxiBundle\Event\TransferOperationEvent;

use DaVinci\TaxiBundle\Services\Remote\RequesterException;

class HomeController extends StepsController 
{
    
    public function indexAction() {
        $result = $this->showSteps();
    	if (is_array($result)) {
            return $this->render(
    			'DaVinciTaxiBundle:Home:createPassengerRequest.html.twig',
    			array_merge($result, array(
                    'openRequests' => $this->getStockRequests(),
                    'vehicleClasses' => VehicleClasses::getFilterChoices()
                ))
    		);
    	} else {
    		return $this->redirect($result);
    	}
    }
    
    /**
     * @Route("/payment/request_id/{id}", name="passenger_request_payment")
     * @Security("has_role('ROLE_USER') or has_role('ROLE_TAXIDRIVER')")
     */
    public function paymentAction() {
    	$passengerRequest = $this->getPassengerRequestWithDriversById($this->getRequest()->get('id'));
    	if (is_null($passengerRequest)) {
    		return $this->redirect($this->generateUrl('da_vinci_taxi_homepage'));
    	}
    	
    	$makePayment = $this->spawnMakePayment();
    	
    	if (!$this->beforePaymentCheck($passengerRequest)) {
    		return $this->redirect($this->generateUrl('da_vinci_taxi_homepage'));
    	}
    	
    	$operationCode = MakePayments::CODE_SUCCESS;
    	
    	$flow = $this->get('taxi.makePayment.form.flow');
    	$flow->bind($makePayment);
    	    	    	
    	$form = $flow->createForm();
    	if ($flow->isValid($form)) {
    		$flow->saveCurrentStepData($form);
    	
    		if ($flow->nextStep()) {
    			$form = $flow->createForm();
    		} else {
    			$user = $this->get('security.context')
	    			->getToken()
	    			->getUser();
    			$driver = null;
    			
    			if ($this->isOtherDriverCondition($passengerRequest)) {
    				$driver = $this->getDirverByUserId($user->getId());
    			
    				$passengerRequest->addPossibleDriver($driver);
    				$passengerRequest->removeCanceledDrivers($driver);
    				    			
    				$driver->addPossibleRequests($passengerRequest);
    				$driver->removeCanceledRequests($passengerRequest);
    			}
    			
    			if ($this->isFirstDriverCondition($passengerRequest)) {
    				$driver = $this->getDirverByUserId($user->getId());

    				$passengerRequest->changeState();
    				$passengerRequest->addPossibleDriver($driver);
    				$passengerRequest->removeCanceledDrivers($driver);
    				    				 
    				$driver->addPossibleRequests($passengerRequest);
    				$driver->removeCanceledRequests($passengerRequest);
    			}
    			
    			if ($this->isUserCondition($passengerRequest)) {
    				$passengerRequest->changeState();
    			}

	    		try {	
	    			$dispatcher = $this->get('event_dispatcher');
	    			$dispatcher->dispatch(
	    				FinancialOfficeEvents::OPERATION_SALE,
	    				new TransferOperationEvent(
							$makePayment,
	    					$this->getMakePaymentRepository(),
	    					$passengerRequest->getFullRoute()	
	    				)
	    			);
	    			
	    			if (!is_null($driver)) {
	    				$this->saveDriver($driver);
	    			}
	    			$this->updatePassengerRequest($passengerRequest);
	    			
	    			$this->getRequest()->getSession()->remove('request_id');
	    			
	    			$flow->reset();
	    			return $this->redirect($this->getAfterPaymentUrl());
    			} catch (RequesterException $exception) {
    				$operationCode = MakePayments::CODE_FAIL;
    			}
    		}
    	}
    	
    	$data = array(
    		'form' => $form->createView(),
    		'flow' => $flow,
    		'passengerRequest' => $passengerRequest,
    		'paymentMethods' => PaymentMethod::getTypes(),
 			'internalMethods' => InternalPaymentMethod::getSubTypes(),
    		'creditCardMethods' => CreditCardPaymentMethod::getSubTypes(),
    		'operationCode'	=> $operationCode
    	);
    	 
    	if ($flow->getCurrentStepNumber() == MakePaymentFlow::STEP_FIRST) {
    		$data['marketPrice'] = $this->getCalculationService()->getMarketPrice($passengerRequest);
    		$data['marketTips'] = $this->getCalculationService()->getMarketTips($passengerRequest);
    	}
    	
    	if ($flow->getCurrentStepNumber() == MakePaymentFlow::STEP_SECOND) {
    		$paymentMethod = $makePayment->getPaymentMethod();
    		$data['paymentMethod'] = $paymentMethod->getType();
    			
    		if (
    			$paymentMethod instanceof CreditCardPaymentMethod
    			|| $paymentMethod instanceof InternalPaymentMethod
    		) {
    			$data['subType'] = $paymentMethod->getSubTypeName();
    		}
    	}
		    	    	 
    	return $this->render(
    		'DaVinciTaxiBundle:Store:payment_page.html.twig',
    		$data
    	);   	
    }
    
    /**
     * @Route("/approve/request_id/{id}", name="approve_request_status", condition="request.headers.get('X-Requested-With') == 'XMLHttpRequest'")
     * @Security("has_role('ROLE_USER') or has_role('ROLE_TAXIDRIVER')")
     */
    public function approveAction()
    {
    	$requestId = $this->getRequest()->get('id');
    	
    	$passengerRequest = $this->getPassengerRequestWithDriversById($requestId);
    	if (is_null($passengerRequest)) {
    		return new JsonResponse(array(
    			'status' => 'error', 
    			'message' => 'undefined request id #' . $requestId
    		));
    	}
    	
    	$userCondition = (
    		PassengerRequest::STATE_PENDING == $passengerRequest->getStateValue()
    		&& $this->get('security.context')->isGranted('ROLE_USER')
    	);
    	$driverCondition = (
    		PassengerRequest::STATE_SOLD == $passengerRequest->getStateValue()
    		&& $this->get('security.context')->isGranted('ROLE_TAXIDRIVER')
    	);
    	
    	if (!$userCondition && !$driverCondition) {
    		return new JsonResponse(array(
    			'status' => 'error', 
    			'message' => 'action can not be completed'
    		));
    	}
    	
    	$driverId = $this->getRequest()->get('driver_id');
    	$driver = $this->getDirverById($driverId);
    	
    	if (is_null($driver)) {
    		return new JsonResponse(array(
    			'status' => 'error',
    			'message' => 'undefined driver id #' . $driverId
    		));
    	}
    	
    	if (
    		$driverCondition
    		&& $driver->getId() != $passengerRequest->getDriver()->getId()
    	) {
    		return new JsonResponse(array(
    			'status' => 'error',
    			'message' => "driver with id #{$driver->getId()} is not chosen for executing an order"
    		));
    	}
    	
    	$dispatcher = $this->container->get('event_dispatcher');
    	$dispatcher->dispatch(
    		PassengerRequestEvents::APPROVE_REQUEST,
    		new CommonDriverRequestEvent(
    			$passengerRequest,
    			$this->getPassengerRequestRepository(),
    			$driver,
    			$this->getIndependentDriverRepository()
    		)
    	);
    	
    	return new JsonResponse(array('status' => 'ok', 'message' => 'completed'));
    }
    
    /**
     * @Route("/decline/driver/request_id/{id}", name="decline_driver", condition="request.headers.get('X-Requested-With') == 'XMLHttpRequest'")
     * @Security("has_role('ROLE_USER')")
     */
    public function declineDriverAction()
    {
    	$requestId = $this->getRequest()->get('id');
    	 
    	$passengerRequest = $this->getPassengerRequestWithDriversById($requestId);
    	if (is_null($passengerRequest)) {
    		return new JsonResponse(array(
    			'status' => 'error', 
    			'message' => 'undefined request id #' . $requestId
    		));
    	}
    	
    	$driverId = $this->getRequest()->get('driver_id');
    	$driver = $this->getDirverById($driverId);
    	if (is_null($driver)) {
    		return new JsonResponse(array(
    			'status' => 'error',
    			'message' => 'undefined driver id #' . $driverId
    		));
    	}
    	    	
    	$dispatcher = $this->get('event_dispatcher');
    	$dispatcher->dispatch(
    		PassengerRequestEvents::DECLINE_DRIVER_REQUEST,
    		new CommonDriverRequestEvent(
    			$passengerRequest,
    			$this->getPassengerRequestRepository(),
    			$driver,
    			$this->getIndependentDriverRepository()
    		)
    	);
    	
    	return new JsonResponse(array('status' => 'ok', 'message' => 'completed'));
    }
    
    /**
     * @Route("/cancel/request_id/{id}", name="cancel_request_status")
     * @Security("has_role('ROLE_USER') or has_role('ROLE_TAXIDRIVER')")
     */
    public function cancelAction()
    {
    	$requestId = $this->getRequest()->get('id');
    	
    	$passengerRequest = $this->getPassengerRequestById($requestId);
    	if (is_null($passengerRequest)) {
            return $this->redirect($this->getRequest()->get('_route'));    		
    	}
    	
    	$dispatcher = $this->get('event_dispatcher');
    	$dispatcher->dispatch(
    		PassengerRequestEvents::CANCEL_REQUEST,
    		new CancelRequestEvent(
    			$passengerRequest, 
    			$this->getPassengerRequestRepository(), 
    			$this->container->get('security.context')
    		)
    	);
    	        
        return $this->redirect($this->getRequest()->get('_route'));
    }
        
    public function mainDriverAction() {
        return $this->render(
            'DaVinciTaxiBundle:Home:main_driver.html.twig',
            array(
                'openRequests' => $this->getStockRequests(),
                'vehicleClasses' => VehicleClasses::getFilterChoices()
            )
        );
    }
    
    /**
     * @return \DaVinci\TaxiBundle\Entity\Payment\MakePayment
     */
    private function spawnMakePayment()
    {
    	$makePaymentService = $this->getMakePaymentService();
    	return $makePaymentService->createConfigured($this->getRequest());
    }
    
    private function getAfterPaymentUrl()
    {
    	if ($this->get('security.context')->isGranted('ROLE_TAXIDRIVER')) {
    		return $this->generateUrl('office_driver');
    	}
    	
    	if ($this->get('security.context')->isGranted('ROLE_USER')) {
    		return $this->generateUrl('office_passenger', array(
				'method' => self::ACTION_SHOW_OPEN_ORDERS
			));
    	}
    }
    
    /**
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
     * @return boolean
     */
    private function beforePaymentCheck(PassengerRequest $passengerRequest)
    {
    	$availableDatetime = new \DateTime('+' . PassengerRequest::AVAILABLE_PICKUP_PERIOD . ' hour');
    	if (1 == $availableDatetime->diff($passengerRequest->getPickUp())->invert) {
    		return false;
    	}
    	    	
    	return (
    		$this->isUserCondition($passengerRequest) 
    		|| $this->isFirstDriverCondition($passengerRequest) 
    		|| $this->isOtherDriverCondition($passengerRequest)
    	);
    }
    
    /**
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
     * @return boolean
     */
    private function isUserCondition(PassengerRequest $passengerRequest)
    {
    	return (
    		PassengerRequest::STATE_BEFORE_OPEN == $passengerRequest->getStateValue()
    		&& $this->get('security.context')->isGranted('ROLE_USER')
    	);
    }
    
    /**
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
     * @return boolean
     */
    private function isFirstDriverCondition(PassengerRequest $passengerRequest)
    {
    	return (
    		PassengerRequest::STATE_OPEN == $passengerRequest->getStateValue()
    		&& $this->get('security.context')->isGranted('ROLE_TAXIDRIVER')
    	);
    }
    
    /**
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
     * @return boolean
     */
    private function isOtherDriverCondition(PassengerRequest $passengerRequest)
    {
    	return (
    		PassengerRequest::STATE_PENDING == $passengerRequest->getStateValue()
    		&& $this->get('security.context')->isGranted('ROLE_TAXIDRIVER')
    	);
    }
                    
}
