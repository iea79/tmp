<?php

namespace DaVinci\TaxiBundle\Entity;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\RoutePoint;
use DaVinci\TaxiBundle\Entity\Tariff;
use DaVinci\TaxiBundle\Entity\Vehicle;
use DaVinci\TaxiBundle\Entity\VehicleOptions;
use DaVinci\TaxiBundle\Entity\VehicleServices;
use DaVinci\TaxiBundle\Entity\VehicleDriverConditions;
use DaVinci\TaxiBundle\Entity\VehicleChildSeat;
use DaVinci\TaxiBundle\Entity\VehiclePetCage;
use DaVinci\TaxiBundle\Entity\PassengerDetail;

/**
 * PassengerRequestService
 */
class PassengerRequestService
{
    
    /**
     * @return PassengerRequest
     */
    public function spawnInstance()
    {
        return new PassengerRequest();
    }

    /**
     * @return PassengerRequest
     */
    public function generateRequest()
	{
		$request = $this->spawnInstance();
		
		$actualTime = new \DateTime();
        $actualTime->setTimezone(new \DateTimeZone(PassengerRequest::REQUEST_TIMEZONE));
		
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
		$request->setVehicleDriverConditions(new VehicleDriverConditions());
        $request->setVehicleServices(new VehicleServices());
		$request->setTariff(new Tariff());
		$request->setPassengerDetail(new PassengerDetail());
		$request->setStateValue(PassengerRequest::STATE_BEFORE_OPEN);
		$request->setIsReal(true);
				
		return $request;
	}
    
    /**
     * @return PassengerRequest
     */
    public function generateFilledRequest(PassengerRequest $filledRequest)
    {
        $vehicleOptions = $filledRequest->getVehicleOptions();
        
        $request = $this->spawnInstance();
        
        foreach ($filledRequest->getRoutePoints() as $routePoint) {
            $request->addRoutePoint($routePoint);
        }
        $request->setDistance($filledRequest->getDistance());
        $request->setDuration($filledRequest->getDuration());
        $request->setCreateDate($filledRequest->getCreateDate());
        $request->setPickUp($filledRequest->getPickUp());
        $request->setRoundTrip($filledRequest->getRoundTrip());
        $request->setReturn($filledRequest->getReturn());
        $request->setVehicle($filledRequest->getVehicle());
		$request->setVehicleOptions($vehicleOptions);
        $request->setVehicleServices($filledRequest->getVehicleServices());
		$request->setVehicleDriverConditions($filledRequest->getVehicleDriverConditions());
		$request->setTariff($filledRequest->getTariff());
		$request->setPassengerDetail($filledRequest->getPassengerDetail());
		$request->setStateValue($filledRequest->getStateValue());
		$request->setIsReal($filledRequest->getIsReal());
                      
        $childSeatsNumber = $vehicleOptions->getChildSeats()->count();
        $childSeatsNumber++;
        for ($count = $childSeatsNumber; $count <= 3; $count++) {
            $request->getVehicleOptions()->addChildSeat(new VehicleChildSeat());
        }
        
        $petCagesNumber = $vehicleOptions->getPetCages()->count();
        $petCagesNumber++;
        for ($count = $petCagesNumber; $count <= 3; $count++) {
            $request->getVehicleOptions()->addPetCage(new VehiclePetCage());
        }
                
        return $request;
    }
    
    /**
     * @param PassengerRequest $request
     * @param PassengerRequest $filledRequest
     * 
     * @return void
     */
    public function updateRequest(PassengerRequest $request, PassengerRequest $filledRequest)
    {
        foreach ($filledRequest->getRoutePoints() as $routePoint) {
            $request->addRoutePoint($routePoint);
        }
        
        $request->setPickUp(new \DateTime(
            $filledRequest->getPickUpDate()->format('Y-m-d') . ' ' 
                . $filledRequest->getPickUpTime()->format('H:i:s')
        ));

        if ($filledRequest->getRoundTrip()) {
            $request->setReturn(new \DateTime(
                $filledRequest->getReturnDate()->format('Y-m-d') . ' ' 
                    . $filledRequest->getReturnTime()->format('H:i:s')
            ));
        }
        
        $request->setTariff($filledRequest->getTariff());
        $tariff = $request->getTariff();
        $tariff->definePrice();
        $tariff->defineTips();
               
        $request->setDistance($filledRequest->getDistance());
        $request->setDuration($filledRequest->getDuration());
        $request->setRoundTrip($filledRequest->getRoundTrip());
        $request->setVehicle($filledRequest->getVehicle());
        $request->setVehicleOptions($filledRequest->getVehicleOptions());
		$request->setVehicleServices($filledRequest->getVehicleServices());
		$request->setVehicleDriverConditions($filledRequest->getVehicleDriverConditions());
		$request->setPassengerDetail($filledRequest->getPassengerDetail());
		$request->setStateValue($filledRequest->getStateValue());
    }
				
}

?>