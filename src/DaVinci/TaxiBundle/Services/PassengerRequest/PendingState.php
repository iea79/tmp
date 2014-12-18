<?php

namespace DaVinci\TaxiBundle\Services\PassengerRequest;

class PendingState extends State 
{

	public function handle()
	{
		$this->context->setState(PassengerRequest::STATE_SOLD);
	}
	
}