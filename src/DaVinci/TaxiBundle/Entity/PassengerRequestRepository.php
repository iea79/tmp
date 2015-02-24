<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PassengerRequestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PassengerRequestRepository extends EntityRepository
{
	
	/**
	 * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $request
	 * @return void
	 */
	public function saveRequest(\DaVinci\TaxiBundle\Entity\PassengerRequest $request)
	{
		$this->_em->persist($request);
		 
		$vehicleOptions = $request->getVehicleOptions();
		$vehicleOptions->setPassengerRequest($request);
		$this->_em->persist($vehicleOptions);
		foreach ($vehicleOptions->getChildSeats() as $seat) {
			if ($seat->getChildSeatNumber() <= 0) {
				continue;
			}
		
			$seat->setVehicleOptions($vehicleOptions);
			$this->_em->persist($seat);
		}
		foreach ($vehicleOptions->getPetCages() as $cage) {
			if ($cage->getPetCageNumber() <= 0) {
				continue;
			}
		
			$cage->setVehicleOptions($vehicleOptions);
			$this->_em->persist($cage);
		}
		
		foreach ($request->getRoutePoints() as $routePoint) {
			$routePoint->setPassengerRequest($request);
			$this->_em->persist($routePoint);
		}
		
		$vehicle = $request->getVehicle();
		$vehicle->setPassengerRequest($request);
		$this->_em->persist($vehicle);
		 
		$tariff = $request->getTariff();
		$tariff->setPassengerRequest($request);
		$this->_em->persist($tariff);
		 
		$passengerDetail = $request->getPassengerDetail();
		$passengerDetail->setPassengerRequest($request);
		$this->_em->persist($passengerDetail);
		 
		$vehicleServices = $request->getVehicleServices();
		$vehicleServices->setPassengerRequest($request);
		$this->_em->persist($vehicleServices);
		 
		$vehicleDriverConditions = $request->getVehicleDriverConditions();
		$vehicleDriverConditions->setPassengerRequest($request);
		$this->_em->persist($vehicleDriverConditions);
		 
		$this->_em->flush();
	}
	
	public function getAllUserRequestsByState($userId, $state)
	{
		$query = $this->_em->createQuery("
			SELECT 
				req 
			FROM 
				DaVinci\TaxiBundle\Entity\PassengerRequest req
			JOIN
				DaVinci\TaxiBundle\Entity\RoutePoint point	 
			WHERE 
				req.user = :userId AND req.stateValue = :stateValue 
			ORDER BY 
				req.id DESC
		");
		$query->setParameters(array(
			'userId' => $userId,
			'stateValue' => $state
		));
		
		return $query->getResult();
	}
	
	public function getAllUserRequestsByStates($userId, array $states)
	{
		$bindValues = array();
		foreach ($states as $key => $value) {
			$bindValues[':stateValue' . $key] = $value;
		}
		$keys = implode(', ', array_keys($bindValues));
		
		$query = $this->_em->createQuery("
			SELECT
				req
			FROM
				DaVinci\TaxiBundle\Entity\PassengerRequest req
			JOIN
				DaVinci\TaxiBundle\Entity\RoutePoint point
			WHERE
				req.user = :userId AND req.stateValue IN ({$keys})
			ORDER BY
				req.id DESC
		");
		$query->setParameters(array_merge(
			array('userId' => $userId),
			$bindValues	
		));
	
		return $query->getResult();
	}
	
}
