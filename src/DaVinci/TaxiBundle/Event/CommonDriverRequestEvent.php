<?php

namespace DaVinci\TaxiBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\SecurityContext;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\PassengerRequestRepository;
use DaVinci\TaxiBundle\Entity\IndependentDriver;
use DaVinci\TaxiBundle\Entity\IndependentDriverRepository;

class CommonDriverRequestEvent extends Event
{
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\PassengerRequest
	 */
	protected $passengerRequest;
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\PassengerRequestRepository
	 */
	protected $passengerRequestRepository;
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\IndependentDriver
	 */
	protected $driver;
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\IndependentDriverRepository
	 */
	protected $driverRepository;
		
	/**
	 * @param PassengerRequest $request
	 * @param PassengerRequestRepository $requestRepository
	 * @param IndependentDriver $driver
	 * @param IndependentDriverRepository $driverRepository
	 */
	public function __construct(
		PassengerRequest $request, 
		PassengerRequestRepository $requestRepository,
		IndependentDriver $driver,
		IndependentDriverRepository $driverRepository
	) {
		$this->passengerRequest = $request;
		$this->passengerRequestRepository = $requestRepository;
		$this->driver = $driver;
		$this->driverRepository = $driverRepository;
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
	 */
	public function getPassengerRequest()
	{
		return $this->passengerRequest;
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\PassengerRequestRepository
	 */
	public function getPassengerRequestRepository() 
	{
		return $this->passengerRequestRepository; 
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\GeneralDriver
	 */
	public function getDriver()
	{
		return $this->driver;
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\IndependentDriverRepository
	 */
	public function getDriverRepository()
	{
		return $this->driverRepository;
	}
		
}

?>