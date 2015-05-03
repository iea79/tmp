<?php

namespace DaVinci\TaxiBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\SecurityContext;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\PassengerRequestRepository;

class PassengerRequestEvent extends Event
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
	 * @var \Symfony\Component\Security\Core\SecurityContext
	 */
	protected $securityContext;
	
	/**
	 * @param PassengerRequest $request
	 * @param PassengerRequestRepository $requestRepository
	 */
	public function __construct(
		PassengerRequest $request, 
		PassengerRequestRepository $requestRepository,
		SecurityContext $securityContext
	) {
		$this->passengerRequest = $request;
		$this->passengerRequestRepository = $requestRepository;
		$this->securityContext = $securityContext; 
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
	 * @return \Symfony\Component\Security\Core\SecurityContext
	 */
	public function getSecurityContext()
	{
		return $this->securityContext;
	}
	
}

?>