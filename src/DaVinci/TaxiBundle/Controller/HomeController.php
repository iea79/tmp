<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use DaVinci\TaxiBundle\Controller\StepsController;

use DaVinci\TaxiBundle\Form\Payment\MakePayment;
use DaVinci\TaxiBundle\Form\Payment\MakePaymentService;
use DaVinci\TaxiBundle\Form\Payment\MakePaymentFlow;
use DaVinci\TaxiBundle\Form\Payment\PaymentMethod;
use DaVinci\TaxiBundle\Form\Payment\CreditCardPaymentMethod;
use DaVinci\TaxiBundle\Form\Payment\InternalPaymentMethod;

use DaVinci\TaxiBundle\Entity\IndependentDriverRepository;
use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\PassengerRequestRepository;
use DaVinci\TaxiBundle\Entity\PassengerRequestService;

use DaVinci\TaxiBundle\Event\PassengerRequestEvents;
use DaVinci\TaxiBundle\Event\CancelRequestEvent;
use DaVinci\TaxiBundle\Event\DeclineDriverRequestEvent;

class HomeController extends StepsController {
	
    public function indexAction() {
    	$result = $this->showSteps();
    	if (is_array($result)) {
    		$allStockRequests = $this->getPassengerRequestRepository()->getActualRequestsByStates(
				array(PassengerRequest::STATE_OPEN)
    		);
    		
    		return $this->render(
    			'DaVinciTaxiBundle:Home:createPassengerRequest.html.twig',
    			array_merge($result, array('openRequests' => $allStockRequests))
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
    	
    	$flow = $this->container->get('taxi.makePayment.form.flow');
    	$flow->bind($makePayment);
    	    	    	
    	$form = $flow->createForm();
    	if ($flow->isValid($form)) {
    		$flow->saveCurrentStepData($form);
    	
    		if ($flow->nextStep()) {
    			$form = $flow->createForm();
    		} else {
    			if ($this->isOtherDriverCondition($passengerRequest)) {
    				$driver = $this->getDirverByUserId(
    					$this->container->get('security.context')
    						->getToken()
    						->getUser()
    						->getId()
    				);
    			
    				$passengerRequest->addPossibleDriver($driver);
    				$passengerRequest->removeCanceledDrivers($driver);
    			
    				$driver->addPossibleRequests($passengerRequest);
    				$driver->removeCanceledRequests($passengerRequest);
    			
    				$this->saveDriver($driver);
    			}
    			
    			if ($this->isFirstDriverCondition($passengerRequest)) {
    				$driver = $this->getDirverByUserId(
    					$this->container->get('security.context')
    						->getToken()
    						->getUser()
    						->getId()
    				);
    				 
    				$passengerRequest->addPossibleDriver($driver);
    				$passengerRequest->removeCanceledDrivers($driver);
    				$passengerRequest->changeState();
    				 
    				$driver->addPossibleRequests($passengerRequest);
    				$driver->removeCanceledRequests($passengerRequest);
    				 
    				$this->saveDriver($driver);
    			}
    			
    			if ($this->isUserCondition($passengerRequest)) {
    				$passengerRequest->changeState();
    			}
    			    			    			    			
    			$this->updatePassengerRequest($passengerRequest);
    			$this->getRequest()->getSession()->remove('request_id');
    			
    			$flow->reset();
    			
    			return $this->redirect($this->getAfterPaymentUrl());
			}
    	}
    	
    	$data = array(
    		'form' => $form->createView(),
    		'flow' => $flow,
    		'passengerRequest' => $passengerRequest,
    		'paymentMethods' => PaymentMethod::getTypes(),
 			'internalMethods' => InternalPaymentMethod::getSubTypes(),
    		'creditCardMethods' => CreditCardPaymentMethod::getSubTypes()
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
    		&& $this->container->get('security.context')->isGranted('ROLE_USER')
    	);
    	$driverCondition = (
    		PassengerRequest::STATE_SOLD == $passengerRequest->getStateValue()
    		&& $this->container->get('security.context')->isGranted('ROLE_TAXIDRIVER')
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
    	
    	if ($userCondition) {
    		$passengerRequest->setDriver($driver);
    		$passengerRequest->removeCanceledDrivers($driver);
    		
    		$driver->removeCanceledRequests($passengerRequest);
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
    	
    	$passengerRequest->changeState();
    	
    	$this->saveDriver($driver);
    	$this->savePassengerRequest($passengerRequest);
    	
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
    	    	
    	$dispatcher = $this->container->get('event_dispatcher');
    	$dispatcher->dispatch(
    		PassengerRequestEvents::DECLINE_DRIVER_REQUEST,
    		new DeclineDriverRequestEvent(
    			$passengerRequest,
    			$this->getPassengerRequestRepository(),
    			$driver,
    			$this->getIndependentDriverRepository(),
    			$this->container->get('da_vinci_taxi.service.composite_informer')
    		)
    	);
    	
    	return new JsonResponse(array('status' => 'ok', 'message' => 'completed'));
    }
    
    /**
     * @Route("/cancel/request_id/{id}", name="cancel_request_status", condition="request.headers.get('X-Requested-With') == 'XMLHttpRequest'")
     * @Security("has_role('ROLE_USER') or has_role('ROLE_TAXIDRIVER')")
     */
    public function cancelAction()
    {
    	$requestId = $this->getRequest()->get('id');
    	
    	$passengerRequest = $this->getPassengerRequestById($requestId);
    	if (is_null($passengerRequest)) {
    		return new JsonResponse(array(
    			'status' => 'error', 
    			'message' => 'undefined request id #' . $requestId
    		));
    	}
    	
    	$dispatcher = $this->container->get('event_dispatcher');
    	$dispatcher->dispatch(
    		PassengerRequestEvents::CANCEL_REQUEST,
    		new CancelRequestEvent(
    			$passengerRequest, 
    			$this->getPassengerRequestRepository(), 
    			$this->container->get('security.context')
    		)
    	);
    	
    	return new JsonResponse(array('status' => 'ok', 'message' => 'completed'));
    }
        
    public function main_driverAction() {
        return $this->render('DaVinciTaxiBundle:Home:main_driver.html.twig');
    }
    
    /**
     * @return \DaVinci\TaxiBundle\Form\Payment\MakePayment
     */
    private function spawnMakePayment()
    {
    	$makePaymentService = $this->getMakePaymentService();
    	
    	$makePayment = $makePaymentService->create();
    	$params = $this->getRequest()->get('makePaymentStepMethod');
    	if (isset($params['paymentMethodCode'])) {
    		$makePaymentService->spawnPaymentMethod($makePayment, $params['paymentMethodCode']);
    		return $makePayment;
    	}
    	
    	$params = $this->getRequest()->get('makePaymentStepPaymentInfo');
    	if (isset($params['paymentMethodCode'])) {
    		$makePaymentService->spawnPaymentMethod($makePayment, $params['paymentMethodCode']);
    		return $makePayment;
    	}
    }
    
    /**
     * @param integer $driverId
     * @return \DaVinci\TaxiBundle\Entity\GeneralDriver
     */
    private function getDirverById($driverId)
    {
    	return $this->getIndependentDriverRepository()->find($driverId);
    }
    
    /**
     * @param integer $userId
     * @return \DaVinci\TaxiBundle\Entity\GeneralDriver
     */
    private function getDirverByUserId($userId)
    {
    	return $this->getIndependentDriverRepository()->findOneByUserId($userId);
    }
    
    /**
     * @param \DaVinci\TaxiBundle\Entity\GeneralDriver $driver
     * @return void
     */
    private function saveDriver(\DaVinci\TaxiBundle\Entity\GeneralDriver $driver)
    {
    	$this->getIndependentDriverRepository()->save($driver);
    }
    
    /**
     * @return \DaVinci\TaxiBundle\Form\Payment\MakePaymentService
     */
    private function getMakePaymentService()
    {
    	return $this->container->get('da_vinci_taxi.service.make_payment_service');
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
    		&& $this->container->get('security.context')->isGranted('ROLE_USER')
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
    		&& $this->container->get('security.context')->isGranted('ROLE_TAXIDRIVER')
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
    		&& $this->container->get('security.context')->isGranted('ROLE_TAXIDRIVER')
    	);
    }
                
}
