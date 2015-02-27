<?php

namespace DaVinci\TaxiBundle\Form\Payment;

class MakePayment 
{
	
	private $balanceType;
	
	/**
	 * @var \DaVinci\TaxiBundle\Form\Payment\PaymentMethod
	 */
	private $paymentMethod;
	
	/**
	 * @var \DaVinci\TaxiBundle\Form\Payment\Money
	 */
	private $money;
	
	public function setMoney(\DaVinci\TaxiBundle\Form\Payment\Money $money)
	{
		$this->money = $money;
	}
	
	public function getMoney()
	{
		return $this->money;
	}
	
}

?>