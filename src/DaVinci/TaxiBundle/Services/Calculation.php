<?php

namespace DaVinci\TaxiBundle\Services;

use DaVinci\TaxiBundle\Entity\PassengerRequest;

class Calculation 
{
	
	const DEFAULT_PRICE = 100.0;
	const DEFAULT_TIPS = 10.0;
	
	public function getMarketPrice(PassengerRequest $request)
	{
		return self::DEFAULT_PRICE;
	}
	
	public function getMarketTips(PassengerRequest $request)
	{
		return self::DEFAULT_TIPS;
	}
	
}

?>