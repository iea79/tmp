<?php

namespace DaVinci\TaxiBundle\Entity;

class Money
{

	/**
	 * @var float
	 */
	private $amount;
	
	/**
	 * @var string
	 */
	private $currency;
	
	public function setCurrency($currency)
	{
		$this->currency = $currency;
	}

	/**
	 * @return string
	 */
	public function getCurrency()
	{
		return $this->currency;
	}
	
	public function setAmount($amount) 
	{
		if (!$this->checkAmount($amount)) {
			throw new \InvalidArgumentException("Invalid amount '{$amount}'");
		}
		
		$this->amount = $amount;		
	}
	
	/**
	 * @return float
	 */
	public function getAmount()
	{
		return $this->amount;
	}
	
	private function checkAmount($amount) 
	{
		return (false !== filter_var($amount, FILTER_VALIDATE_FLOAT));
	}
	
}

?>