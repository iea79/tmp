<?php

namespace DaVinci\TaxiBundle\Form\Payment;

class MakePayment 
{
	
	const BALANCE_TYPE_PRIVATE = 'private';
	const BALANCE_TYPE_BUSINESS = 'business';
	
	private $balanceType;
	
	/**
	 * @var \DaVinci\TaxiBundle\Form\Payment\PaymentMethod
	 */
	private $paymentMethod;
	
	/**
	 * @var \DaVinci\TaxiBundle\Form\Payment\Money
	 */
	private $totalPrice;
	
	static public $balanceTypes = array(
		self::BALANCE_TYPE_PRIVATE,
		self::BALANCE_TYPE_BUSINESS	
	);

	public function setBalanceType($balanceType)
	{
		if (!array_key_exists($balanceType, self::$balanceTypes)) {
			throw new \InvalidArgumentException("Unsupported balance type code: {$balanceType}");
		}
		$this->balanceType = $balanceType;
	
		return $this;
	}
	
	public function getBalanceType()
	{
		return $this->balanceType;
	}
	
	public function setTotalPrice(\DaVinci\TaxiBundle\Form\Payment\Money $totalPrice)
	{
		$this->totalPrice = $totalPrice;
		
		return $this;
	}
	
	public function getTotalPrice()
	{
		return $this->totalPrice;
	}
	
	public function setPaymentMethod(\DaVinci\TaxiBundle\Form\Payment\PaymentMethod $paymentMethod)
	{
		$this->paymentMethod = $paymentMethod;
		
		return $this;
	}
	
	public function getPaymentMethod()
	{
		return $this->paymentMethod;
	}
	
	static public function getBalanceTypes()
	{
		return self::$balanceTypes;
	}
	
}

?>