<?php

namespace DaVinci\TaxiBundle\Services\PassengerRequest;

class BeforeOpenState extends State 
{

	public function handle()
	{
		$this->context->setState(PassengerRequest::STATE_OPEN);
	}
	
}