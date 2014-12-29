<?php

namespace DaVinci\TaxiBundle\Services\PassengerRequest;

class CompletedState extends State 
{

	public function handle()
	{
		$this->context->setState(PassengerRequest::STATE_COMPLETED);
	}
	
}