<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\PassengerRequestRepository;
use DaVinci\TaxiBundle\Entity\PassengerRequestService;
use DaVinci\TaxiBundle\Form\Payment\MakePayment;
use DaVinci\TaxiBundle\Form\Payment\MakePaymentService;

use DaVinci\TaxiBundle\Form\PassengerRequest\CreatePassengerRequestFlow;
use DaVinci\TaxiBundle\Form\Payment\MakePaymentFlow;
use DaVinci\TaxiBundle\Form\Payment\PaymentMethod;
use DaVinci\TaxiBundle\Form\Payment\CreditCardPaymentMethod;
use DaVinci\TaxiBundle\Form\Payment\InternalPaymentMethod;

class HomeController extends Controller {
	
	/**
	 * @Route("/", name="da_vinci_taxi_homepage")
	 */
    public function indexAction() {
    	$passengerRequest = $this->spawnPassengerRequest();
    	
        $flow = $this->container->get('taxi.passengerRequest.form.flow');
    	$flow->bind($passengerRequest);
    	
    	$form = $flow->createForm();
    	if ($flow->isValid($form)) {
    		$flow->saveCurrentStepData($form);
    		
    		if ($flow->nextStep()) {
    			$form = $flow->createForm();
    		} else {
    			if ($this->container->get('security.context')->isGranted('ROLE_USER')) {
    				$passengerRequest->setUser(
    					$this->container->get('security.context')->getToken()->getUser()
    				);
    			}
    			
    			$this->createPassengerRequest($passengerRequest);
    			$flow->reset();
    			
    			$this->getRequest()->getSession()->set('request_id', $passengerRequest->getId());
    			    			    			
    			$url = ($this->container->get('security.context')->isGranted('ROLE_USER'))
    				? $this->generateUrl('passenger_request_payment', array(
	    				'id' => $passengerRequest->getId()
	    			))
    				: $this->generateUrl('fos_user_security_login');
    			
    			return $this->redirect($url);
    		}
    	}

    	$data = array(
	    	'form' => $form->createView(),
	    	'flow' => $flow
    	);
    	
    	if ($flow->getCurrentStepNumber() == CreatePassengerRequestFlow::STEP_THIRD) {
    		$data['marketPrice'] = $this->getCalculationService()->getMarketPrice($passengerRequest);
    		$data['marketTips'] = $this->getCalculationService()->getMarketTips($passengerRequest);
    	}
    	
    	return $this->render(
    		'DaVinciTaxiBundle:Home:createPassengerRequest.html.twig',
    		$data		
    	);
    }
    
    /**
     * @Route("/payment/request_id/{id}", name="passenger_request_payment")
     * @Security("has_role('ROLE_USER')")
     */
    public function paymentAction() {
    	$passengerRequest = $this->getPassengerRequestById($this->getRequest()->get('id'));
    	$makePayment = $this->spawnMakePayment();
    	
    	$flow = $this->container->get('taxi.makePayment.form.flow');
    	$flow->bind($makePayment);
    	    	    	
    	$form = $flow->createForm();
    	if ($flow->isValid($form)) {
    		$flow->saveCurrentStepData($form);
    	
    		if ($flow->nextStep()) {
    			$form = $flow->createForm();
    		} else {
    			$passengerRequest->changeState();
    			$this->savePassengerRequest($passengerRequest);
    			
    			$flow->reset();
    			
    			return $this->redirect($this->generateUrl('passenger_request_generated'));
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
     * @Route("/generated", name="passenger_request_generated")
     */
    public function requestGeneratedAction() {
    	return $this->render("DaVinciTaxiBundle:Home:requestGenerated.html.twig");
    }
    
    public function main_driverAction() {
        return $this->render('DaVinciTaxiBundle:Home:main_driver.html.twig');
    }
    
    /**
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
     */
    private function spawnPassengerRequest() 
    {
    	return $this->getPassengerRequestService()->spawnRequest();
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
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $request
     * @return void
     */
    private function createPassengerRequest(PassengerRequest $request)
    {
    	$em = $this->container->get('doctrine')->getManager();
    	$em->getRepository('DaVinci\TaxiBundle\Entity\PassengerRequest')->create($request);
    }
    
    /**
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $request
     * @return void
     */
    private function savePassengerRequest(PassengerRequest $request)
    {
    	$em = $this->container->get('doctrine')->getManager();
    	$em->getRepository('DaVinci\TaxiBundle\Entity\PassengerRequest')->save($request);
    }
    
    /**
     * @param integer $id
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
     */
    private function getPassengerRequestById($id)
    {
    	$em = $this->container->get('doctrine')->getManager();
    	return $em->getRepository('DaVinci\TaxiBundle\Entity\PassengerRequest')->find($id);
    }
    
    /**
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequestService
     */
    private function getPassengerRequestService()
    {
    	return $this->container->get('da_vinci_taxi.service.passenger_request_service');
    }
    
    /**
     * @return \DaVinci\TaxiBundle\Services\Calculation
     */
    private function getCalculationService()
    {
    	return $this->container->get('da_vinci_taxi.service.calculation_service');
    }
    
    /**
     * @return \DaVinci\TaxiBundle\Form\Payment\MakePaymentService
     */
    private function getMakePaymentService()
    {
    	return $this->container->get('da_vinci_taxi.service.make_payment_service');
    }
        
}
