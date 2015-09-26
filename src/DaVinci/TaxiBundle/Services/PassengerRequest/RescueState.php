<?php

namespace DaVinci\TaxiBundle\Services\PassengerRequest;

use DaVinci\TaxiBundle\Entity\PassengerRequest;

class PassengerRequestRescueState extends State 
{

	public function handleRescue()
	{
		$this->context->setState(PassengerRequest::STATE_RESCUE_PENDING);
	}
	
}