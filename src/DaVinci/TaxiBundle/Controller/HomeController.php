<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\RoutePoint;
use DaVinci\TaxiBundle\Entity\Tariff;
use DaVinci\TaxiBundle\Entity\Vehicle;
use DaVinci\TaxiBundle\Entity\VehicleOptions;
use DaVinci\TaxiBundle\Entity\VehicleChildSeat;
use DaVinci\TaxiBundle\Entity\VehiclePetCage;
use DaVinci\TaxiBundle\Entity\PassengerDetail;

use Symfony\Component\HttpFoundation\RedirectResponse;

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
    			
    			return new RedirectResponse(
    				$this->container->get('router')->generate('passenger_request_generated')
    			);
    		}
    	}
    	
    	$data = array(	
	    	'form' => $form->createView(),
	    	'flow' => $flow		
    	);
    	if ($flow->getCurrentStepNumber() == 3) {
    		$data['marketPrice'] = $this->getMarketPrice();
    		$data['marketTips'] = $this->getMarketTips();
    	}
    	
    	return $this->render(
    		'DaVinciTaxiBundle:Home:createPassengerRequest.html.twig',
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

    public function new_ticketAction()
    {
        return $this->render('DaVinciTaxiBundle:Notifications:new_ticket.html.twig');
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
    private function spawnPassengerRequest() {
    	$request = new PassengerRequest();
    
    	$actualTime = new \DateTime();
    	
    	$vehicleOptions = new VehicleOptions();
    	$vehicleOptions->addChildSeat(new VehicleChildSeat());
    	$vehicleOptions->addChildSeat(new VehicleChildSeat());
    	$vehicleOptions->addChildSeat(new VehicleChildSeat());
    	$vehicleOptions->addPetCage(new VehiclePetCage());
    	$vehicleOptions->addPetCage(new VehiclePetCage());
    	$vehicleOptions->addPetCage(new VehiclePetCage());
    
    	$request->addRoutePoint(new RoutePoint());
    	$request->addRoutePoint(new RoutePoint());
    	$request->setCreateDate($actualTime);
    	$request->setPickUp($actualTime);
    	$request->setReturn($actualTime);
    	$request->setVehicle(new Vehicle());
    	$request->setVehicleOptions($vehicleOptions);
    	$request->setTariff(new Tariff());
    	$request->setPassengerDetail(new PassengerDetail());
    	$request->setStateValue(PassengerRequest::STATE_BEFORE_OPEN);
    	 
    	return $request;
    }
    
    /**
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $request
     * @return void
     */
    private function saveRequest(\DaVinci\TaxiBundle\Entity\PassengerRequest $request)
    {
    	$em = $this->container->get('doctrine')->getManager();
    	$em->persist($request);
    	
    	$vehicleOptions = $request->getVehicleOptions();
    	$vehicleOptions->setPassengerRequest($request);
    	$em->persist($vehicleOptions);
    	foreach ($vehicleOptions->getChildSeats() as $seat) {
    		if ($seat->getChildSeatNumber() <= 0) {
    			continue;
    		}
    		
    		$seat->setVehicleOptions($vehicleOptions);
    		$em->persist($seat);
    	}
    	foreach ($vehicleOptions->getPetCages() as $cage) {
    		if ($cage->getPetCageNumber() <= 0) {
    			continue;
    		}
    		
    		$cage->setVehicleOptions($vehicleOptions);
    		$em->persist($cage);
    	}
    	    	    	    	
    	foreach ($request->getRoutePoints() as $routePoint) {
    		$routePoint->setPassengerRequest($request);
    		$em->persist($routePoint);
    	}

    	$vehicle = $request->getVehicle();
    	$vehicle->setPassengerRequest($request);
    	$em->persist($vehicle);
    	
    	$tariff = $request->getTariff();
    	$tariff->setPassengerRequest($request);
    	$em->persist($tariff);
    	
    	$passengerDetail = $request->getPassengerDetail();
    	$passengerDetail->setPassengerRequest($request);
    	$em->persist($passengerDetail);
    	
    	$vehicleServices = $request->getVehicleServices();
    	$vehicleServices->setPassengerRequest($request);
    	$em->persist($vehicleServices);
    	
    	$vehicleDriverConditions = $request->getVehicleDriverConditions();
    	$vehicleDriverConditions->setPassengerRequest($request);
    	$em->persist($vehicleDriverConditions);
    	
    	$em->flush();
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
