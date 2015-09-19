<?php

namespace DaVinci\TaxiBundle\Event;

use Symfony\Component\EventDispatcher\Event;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\PassengerRequestRepository;

class CancelRequestEvent extends Event
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
     * @var string 
     */
    protected $initiatedBy;

    /**
	 * @param PassengerRequest $request
	 * @param PassengerRequestRepository $requestRepository
     * @param string $initiatedBy
	 */
	public function __construct(
		PassengerRequest $request, 
		PassengerRequestRepository $requestRepository,
        $initiatedBy
	) {
		$this->passengerRequest = $request;
		$this->passengerRequestRepository = $requestRepository;
        $this->initiatedBy = $initiatedBy;
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
     * @return string
     */
    public function getInitiatedBy() 
    {
        return $this->initiatedBy;
    }
	
}

?>