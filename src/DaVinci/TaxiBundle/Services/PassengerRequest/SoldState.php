<?php

namespace DaVinci\TaxiBundle\Services\PassengerRequest;

class SoldState extends State 
{

	public function handle()
	{
		$this->context->setState(PassengerRequest::STATE_COMPLETED);
	}
	
}