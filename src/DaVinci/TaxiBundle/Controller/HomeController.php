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
    	
    	return $this->render(
    		'DaVinciTaxiBundle:Home:createPassengerRequest.html.twig',
    		array(	
	    		'form' => $form->createView(),
	    		'flow' => $flow	
    		)		
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
    	foreach ($vehicleOptions->getChildSeats() as $seat) {
    		$em->persist($seat);
    	}
    	foreach ($vehicleOptions->getPetCages() as $cage) {
    		$em->persist($cage);
    	}
    	    	
    	foreach ($request->getRoutePoints() as $routePoint) {
    		$em->persist($routePoint);
    	}
    	    	
    	$em->persist($request->getVehicle());
    	$em->persist($request->getTariff());
    	$em->persist($request->getPassengerDetail());
    	
    	$em->flush();
    }

}
