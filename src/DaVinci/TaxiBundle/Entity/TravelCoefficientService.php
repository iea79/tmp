<?php

namespace DaVinci\TaxiBundle\Entity;

use DaVinci\TaxiBundle\Utils\Assert;

/**
 * TravelCoefficientService
 */
class TravelCoefficientService
{
	
	/**
	 * @var TravelCoefficientRepository
	 */
	private $repository;
	
	/**
	 * @var array
	 */
	private $hashCoefficients = array();
	
	/**
	 * @var array
	 */
	private $hashTips = array();
	
	public function setTravelCoefficientRepository(TravelCoefficientRepository $repository)
	{
		$this->repository = $repository;
	}
		
	/**
	 * @param string $vehicleClass
	 * @return float
	 */
	public function getCoefficientByVehicleClass($vehicleClass)
	{
		Assert::inArray(
			VehicleClasses::getPossibleChoices(),
			$vehicleClass,
			get_class($this) . ": undefined vehicle class #{$vehicleClass}"
		);
		
		if (!count($this->hashCoefficients)) {
			$this->generateHashes();
		}
		
		return (isset($this->hashCoefficients[$vehicleClass])) 
			? $this->hashCoefficients[$vehicleClass]
			: 0;
	}
	
	/**
	 * @param string $vehicleClass
	 * @return float
	 */
	public function getTipsByVehicleClass($vehicleClass)
	{
		Assert::inArray(
			VehicleClasses::getPossibleChoices(),
			$vehicleClass,
			get_class($this) . ": undefined vehicle class #{$vehicleClass}"
		);
	
		if (!count($this->hashTips)) {
			$this->generateHashes();
		}
	
		return (isset($this->hashTips[$vehicleClass])) 
			? $this->hashTips[$vehicleClass]
			: 0;
	}
	
	private function generateHashes()
	{
		$items = $this->repository->findAll();
		
		foreach ($items as $item) {
			$this->hashCoefficients[$item->getVehicleClass()] = $item->getConcreteValue();
			$this->hashTips[$item->getVehicleClass()] = $item->getTipsValue();
		}
	}
			
}

?>