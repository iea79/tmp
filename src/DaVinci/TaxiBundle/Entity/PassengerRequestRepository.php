<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine;

/**
 * PassengerRequestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PassengerRequestRepository extends EntityRepository
{
	
	const DEFAULT_INTERVAL_HOURS = 24;
	const DEFAULT_LIMIT_ROWS = 10;
	
	/**
	 * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $request
	 * @return void
	 */
	public function saveAll(\DaVinci\TaxiBundle\Entity\PassengerRequest $request)
	{
		$this->persistAll($request);		 
		$this->_em->flush();
	}
	
	/**
	 * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $request
	 * @return void
	 */
	public function save(\DaVinci\TaxiBundle\Entity\PassengerRequest $request)
	{
		$this->_em->persist($request);
		$this->_em->flush();
	}
	
	public function getFullRequestById($id)
	{
		$query = $this->_em->createQuery("
			SELECT
				req, points, vehicle, detail, options, seats, cages, services, conditions
			FROM
				DaVinci\TaxiBundle\Entity\PassengerRequest req
			JOIN
				req.routePoints points
			JOIN
				req.vehicle vehicle
			JOIN
				req.passengerDetail detail	
			JOIN
				req.vehicleOptions options
			JOIN
				options.childSeats seats
			JOIN
				options.petCages cages		
			JOIN
				req.vehicleServices services
			JOIN
				req.vehicleDriverConditions	conditions			
			WHERE
				req.id = :requestId
		");
		$query->setParameters(array('requestId' => $id));
		
		return $query->getOneOrNullResult();
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
		$query = $this->_em->createQuery("
			SELECT
				req
			FROM
				DaVinci\TaxiBundle\Entity\PassengerRequest req
			JOIN
				req.routePoints points
			WHERE
				req.user = :userId AND req.stateValue IN (:stateValues)
			ORDER BY 
				req.id DESC
		");
		$query->setParameters(array(
			'userId' => $userId,
			'stateValues' => $states	
		));
	
		return $query->getResult();
	}
	
	public function getActualRequestsByStates(array $states)
	{
		$query = $this->_em->createQuery("
			SELECT
				req
			FROM
				DaVinci\TaxiBundle\Entity\PassengerRequest req
			JOIN
				req.routePoints points
			JOIN
				req.tariff tariff	
			WHERE
				DATE_DIFF(req.pickUp, :pickUp) > 0
				AND req.stateValue IN (:stateValues)
			ORDER BY
				req.id DESC	
		");
		$query->setParameter(
			'pickUp', 
			new \DateTime("+" . self::DEFAULT_INTERVAL_HOURS . " hours"), 
			\Doctrine\DBAL\Types\Type::DATETIMETZ
		);
		$query->setParameter('stateValues', $states);
		$query->setMaxResults(self::DEFAULT_LIMIT_ROWS);
									
		return $query->getResult();
	}
	
	/**
	 * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $request
	 * @return void
	 */
	private function persistAll(\DaVinci\TaxiBundle\Entity\PassengerRequest $request)
	{
		$this->_em->persist($request);
		
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
		
		foreach ($request->getRoutePoints() as $routePoint) {
			$routePoint->setPassengerRequest($request);
			$this->_em->persist($routePoint);
		}
		
		$vehicleOptions = $request->getVehicleOptions();
		$vehicleOptions->setPassengerRequest($request);
		$this->_em->persist($vehicleOptions);
		
		foreach ($vehicleOptions->getPetCages() as $cage) {
			$cage->setVehicleOptions($vehicleOptions);
			$this->_em->persist($cage);
		}
		
		foreach ($vehicleOptions->getChildSeats() as $seat) {
			$seat->setVehicleOptions($vehicleOptions);
			$this->_em->persist($seat);
		}
	}
	
}
