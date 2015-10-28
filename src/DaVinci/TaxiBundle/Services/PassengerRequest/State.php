<?php

namespace DaVinci\TaxiBundle\Services\PassengerRequest;

use DaVinci\TaxiBundle\Entity\PassengerRequest;

class State
{
	
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\PassengerRequest $context
	 */
	protected $context;
	
	public function __construct(\DaVinci\TaxiBundle\Entity\PassengerRequest $context)
	{
		$this->context = $context;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function handle()
	{
		throw new \UnexpectedValueException("Passenger request has undefined state {$this->getName()}!");
	}
	
	public function handleRescue()
	{
		throw new \UnexpectedValueException("Passenger request has undefined rescue state {$this->getName()}!");
	}
	
	public function resetToPending()
	{
		$this->context->setState(PassengerRequest::STATE_PENDING);
	}
	
	public function cancel()
	{
		$this->context->setState(PassengerRequest::STATE_CANCELED);
	}
	
	public function rescue()
	{
		if (PassengerRequest::STATE_SOLD != $this->context->getState()) {
			throw new \UnexpectedValueException("State change from '{$this->context->getState()}' to 'rescue' is not allowed!");
		}
		
		$this->context->setState(PassengerRequest::STATE_RESCUE);
	}
	
}