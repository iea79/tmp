<?php

namespace DaVinci\TaxiBundle\Services;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\TravelCoefficientService;

class Calculation 
{
	
	const BASIC_PRICE = 0.41;
	
	const DEFAULT_PRICE = 100.0;
	const DEFAULT_TIPS = 5.0;
	
	/**
	 * @var TravelCoefficientService
	 */
	private $travelService;
		
	public function setTravelCoefficientService(TravelCoefficientService $travelService)
	{
		$this->travelService = $travelService;
	}
	
	public function getMarketPrice(PassengerRequest $request)
	{
		$coefficient = $this->travelService->getCoefficientByVehicleClass(
			$request->getVehicle()->getVehicleClassName()
		);
				
		$price = ($coefficient)
			? $request->getFormattedDistance() * $coefficient * self::BASIC_PRICE
			: self::DEFAULT_PRICE;

		return number_format($price, 2, '.', '');
	}
	
	public function getMarketTips(PassengerRequest $request)
	{
		$tips = $this->travelService->getTipsByVehicleClass(
			$request->getVehicle()->getVehicleClassName()
		);
		
		return ($tips)
			? $tips
			: self::DEFAULT_TIPS;
	}
	
}

?>