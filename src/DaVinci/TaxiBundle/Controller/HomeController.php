<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\PassengerRequestRepository;
use DaVinci\TaxiBundle\Entity\PassengerRequestService;

use Symfony\Component\HttpFoundation\RedirectResponse;
use DaVinci\TaxiBundle\Form\PassengerRequest\CreatePassengerRequestFlow;
use Entity;

class HomeController extends Controller {
	
	const DEFAULT_PRICE = 100.0;
	const DEFAULT_TIPS = 10.0;
	
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
    			$this->saveRequest($passengerRequest);
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
	    	'flow' => $flow,
    		'newRequestId' => $this->getRequest()->getSession()->get('request_id')
    	);
    	
    	if ($flow->getCurrentStepNumber() == CreatePassengerRequestFlow::STEP_THIRD) {
    		$data['marketPrice'] = $this->getMarketPrice();
    		$data['marketTips'] = $this->getMarketTips();
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
    	return $this->render("DaVinciTaxiBundle:Store:payment_page_1.html.twig");
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
    	return $this->container->get('da_vinci_taxi.service.passenger_request_service')->spawnRequest();
    }
    
    /**
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $request
     * @return void
     */
    private function saveRequest(\DaVinci\TaxiBundle\Entity\PassengerRequest $request)
    {
    	$em = $this->container->get('doctrine')->getManager();
    	$em->getRepository('DaVinci\TaxiBundle\Entity\PassengerRequest')->saveRequest($request);
    }
    
    private function getMarketPrice()
    {
    	return self::DEFAULT_PRICE;
    }
    
    private function getMarketTips()
    {
    	return self::DEFAULT_TIPS;
    }

}
