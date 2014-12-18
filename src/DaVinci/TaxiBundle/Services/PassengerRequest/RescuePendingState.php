<?php

namespace DaVinci\TaxiBundle\Services\PassengerRequest;

class RescuePendingState extends State 
{

	public function handleRescue()
	{
		$this->context->setState(PassengerRequest::STATE_RESCUE_CLOSED);
	}
	
}