<?php

namespace DaVinci\TaxiBundle\Services\PassengerRequest;

use DaVinci\TaxiBundle\Entity\PassengerRequest;

class RescueClosedState extends State 
{

	public function handleRescue()
	{
		$this->context->setState(PassengerRequest::STATE_COMPLETED);
	}
	
}