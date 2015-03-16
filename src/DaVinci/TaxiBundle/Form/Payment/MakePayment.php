<?php

namespace DaVinci\TaxiBundle\Form\Payment;

class MakePayment 
{
		
	/**
	 * @var \DaVinci\TaxiBundle\Form\Payment\PaymentMethod
	 */
	private $paymentMethod;
	
	/**
	 * @var integer
	 */
	private $paymentMethodCode;
		
	/**
	 * @var \DaVinci\TaxiBundle\Form\Payment\Money
	 */
	private $totalPrice;
	
	public function setTotalPrice(\DaVinci\TaxiBundle\Form\Payment\Money $totalPrice)
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
	
	public function setPaymentMethod(\DaVinci\TaxiBundle\Form\Payment\PaymentMethod $paymentMethod)
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