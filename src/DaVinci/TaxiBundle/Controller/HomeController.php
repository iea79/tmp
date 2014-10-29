<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\RoutePoint;
use Doctrine\Common\Collections\ArrayCollection;

class HomeController extends Controller {
	
	/**
	 * @Route("/", name="da_vinci_taxi_homepage")
	 */
    public function indexAction() {
        $flow = $this->container->get('taxi.passengerRequest.form.flow');
    	$flow->bind($this->spawnPassengerRequest());
    	
    	$form = $flow->createForm();
    	if ($flow->isValid($form)) {
    		
    	}
    	
    	return $this->render(
    		'DaVinciTaxiBundle:Home:createPassengerRequest.html.twig',
    		array (	
	    		'form' => $form->createView(),
	    		'flow' => $flow	
    		)		
    	);
    }
    
    public function main_driverAction() {
        return $this->render('DaVinciTaxiBundle:Home:main_driver.html.twig');
    }
    
    /**
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
     */
    private function spawnPassengerRequest() {
    	$request = new PassengerRequest();
    	
    	$actualTime = new \DateTime();
    	
    	$request->addRoutePoint(new RoutePoint());
    	$request->addRoutePoint(new RoutePoint());
    	$request->setCreateDate($actualTime);
    	$request->setPickUp($actualTime);
    	$request->setReturn($actualTime);    	
    	    	
    	return $request;
    }
    

    public function profitAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:profit.html.twig');
    }

    public function profit_passengerAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:profit_passenger.html.twig');
    }

    public function profit_driverAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:profit_driver.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:about.html.twig');
    }

}
