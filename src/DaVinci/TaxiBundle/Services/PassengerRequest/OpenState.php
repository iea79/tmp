<?php

namespace DaVinci\TaxiBundle\Services\PassengerRequest;

class OpenState extends State 
{

	public function handle()
	{
		$this->context->setState(PassengerRequest::STATE_PENDING);
	}
	
}