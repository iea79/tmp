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
    
    public function profitAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        $driverTabs= $dm->getRepository('DaVinciTaxiBundle:ProfitPage')->getDriverProfitTab();
        $passengerTabs= $dm->getRepository('DaVinciTaxiBundle:ProfitPage')->getPassengerProfitTab();
        
        return $this->render('DaVinciTaxiBundle:Home:profit.html.twig',
                array(
                    'driver_tabs' => $driverTabs,
                    'passenger_tabs' => $passengerTabs
                ));
    }

    public function aboutAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        $allTabs= $dm->getRepository('DaVinciTaxiBundle:AboutPage')->findAll();
        
        return $this->render('DaVinciTaxiBundle:Home:about.html.twig',
                array(
                    'all_tabs' => $allTabs,
                ));
    }

    public function helpAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:help.html.twig');
    }

    public function view_officesAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:view_offices.html.twig');
    }

    public function videoAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:video.html.twig');
    }
    
    public function instructionsAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:instructions.html.twig');
    }

    public function one_helpAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:one_help.html.twig');
    }

    public function FAQsAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:FAQs.html.twig');
    }

    public function notificationsAction()
    {
        return $this->render('DaVinciTaxiBundle:Notifications:notifications.html.twig');
    }

    public function informationAction()
    {
        return $this->render('DaVinciTaxiBundle:Information:information.html.twig');
    }

    public function financial_officeAction()
    {
        return $this->render('DaVinciTaxiBundle:Finoffice:financial_office.html.twig');
    }
    
    public function storeAction()
    {
        return $this->render('DaVinciTaxiBundle:Store:store.html.twig');
    }
    
    public function sale_pageAction()
    {
        return $this->render('DaVinciTaxiBundle:Store:sale_page.html.twig');
    }

    public function letter_confirmAction()
    {
        return $this->render('DaVinciTaxiBundle:Email:letter_confirm.html.twig');
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
    	$this->container->get('da_vinci_taxi.repository.passenger_request_repository')->saveRequest($request);
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
