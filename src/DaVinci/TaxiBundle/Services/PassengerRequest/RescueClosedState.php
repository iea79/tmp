<?php

namespace DaVinci\TaxiBundle\Services\PassengerRequest;

class RescueClosedState extends State 
{

	public function handleRescue()
	{
		$this->context->setState(PassengerRequest::STATE_COMPLETED);
	}
	
}