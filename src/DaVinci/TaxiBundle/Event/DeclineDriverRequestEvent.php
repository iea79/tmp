<?php

namespace DaVinci\TaxiBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\SecurityContext;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\PassengerRequestRepository;
use DaVinci\TaxiBundle\Entity\IndependentDriver;
use DaVinci\TaxiBundle\Services\Informer\InformerInterface;
use DaVinci\TaxiBundle\Entity\IndependentDriverRepository;

class DeclineDriverRequestEvent extends Event
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
	 * @var \DaVinci\TaxiBundle\Services\Informer\InformerInterface
	 */
	protected $informer;
	
	/**
	 * @param PassengerRequest $request
	 * @param PassengerRequestRepository $requestRepository
	 * @param IndependentDriver $driver
	 * @param IndependentDriverRepository $driverRepository
	 * @param InformerInterface $informer
	 */
	public function __construct(
		PassengerRequest $request, 
		PassengerRequestRepository $requestRepository,
		IndependentDriver $driver,
		IndependentDriverRepository $driverRepository,	
		InformerInterface $informer		
	) {
		$this->passengerRequest = $request;
		$this->passengerRequestRepository = $requestRepository;
		$this->driver = $driver;
		$this->driverRepository = $driverRepository;
		$this->informer = $informer;
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
	
	/**
	 * @return \DaVinci\TaxiBundle\Services\Informer\InformerInterface
	 */
	public function getInformer()
	{
		return $this->informer;
	}
	
}

?>