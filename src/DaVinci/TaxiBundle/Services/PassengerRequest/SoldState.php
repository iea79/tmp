<?php

namespace DaVinci\TaxiBundle\Services\PassengerRequest;

use DaVinci\TaxiBundle\Entity\PassengerRequest;

class SoldState extends State 
{

	public function handle()
	{
		$this->context->setState(PassengerRequest::STATE_COMPLETED);
	}
	
}