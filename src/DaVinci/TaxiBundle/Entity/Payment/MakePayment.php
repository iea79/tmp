<?php

namespace DaVinci\TaxiBundle\Entity\Payment;

class MakePayment 
{
		
	/**
	 * @var \DaVinci\TaxiBundle\Entity\Payment\PaymentMethod
	 */
	private $paymentMethod;
	
	/**
	 * @var integer
	 */
	private $paymentMethodCode;
		
	/**
	 * @var \DaVinci\TaxiBundle\Entity\Payment\Money
	 */
	private $totalPrice;
	
	public function setTotalPrice(\DaVinci\TaxiBundle\Entity\Money $totalPrice)
	{
		$this->totalPrice = $totalPrice;
		
		return $this;
	}
	
	public function getTotalPrice()
	{
		return $this->totalPrice;
	}
	
	public function setPaymentMethodCode($paymentMethodCode)
	{
		$this->paymentMethodCode = $paymentMethodCode;
	
		return $this;
	}
	
	public function getPaymentMethodCode()
	{
		return $this->paymentMethodCode;
	}
	
	public function setPaymentMethod(\DaVinci\TaxiBundle\Entity\Payment\PaymentMethod $paymentMethod)
	{
		$this->paymentMethod = $paymentMethod;
		
		return $this;
	}
	
	public function getPaymentMethod()
	{
		return $this->paymentMethod;
	}
			
}

?>