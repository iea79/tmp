<?php

namespace DaVinci\TaxiBundle\Entity;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\RoutePoint;
use DaVinci\TaxiBundle\Entity\Tariff;
use DaVinci\TaxiBundle\Entity\Vehicle;
use DaVinci\TaxiBundle\Entity\VehicleOptions;
use DaVinci\TaxiBundle\Entity\VehicleDriverConditions;
use DaVinci\TaxiBundle\Entity\VehicleChildSeat;
use DaVinci\TaxiBundle\Entity\VehiclePetCage;
use DaVinci\TaxiBundle\Entity\PassengerDetail;

/**
 * PassengerRequestService
 */
class PassengerRequestService
{
	
	public function generateRequest()
	{
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
		$request->setVehicleDriverConditions(new VehicleDriverConditions());
		$request->setTariff(new Tariff());
		$request->setPassengerDetail(new PassengerDetail());
		$request->setStateValue(PassengerRequest::STATE_BEFORE_OPEN);
		
		return $request;
	}
			
}

?>