<?php

namespace DaVinci\TaxiBundle\Form\Payment;

abstract class PaymentMethod 
{
	
	const CLASS_END = 'PaymentMethod';
	
	const CREDIT_CARD_METHOD = 'CreditCard';
	const PAYPAL_METHOD = 'PayPal';
	const SKRILL_METHOD = 'Skrill';
	
	/**
	 * @var string
	 */
	protected $company;
	
	/**
	 * @var srting
	 */
	protected $type;
	
	public function setCompany($company) 
	{
		$this->company = $company;
		
		return $this;
	}
	
	public function getCompany()
	{
		return $this->company;
	}
		
	public function getType()
	{
		$className = get_class($this);
		return substr($className, 0, strpos($className, self::CLASS_END));
	}
	
}

?>