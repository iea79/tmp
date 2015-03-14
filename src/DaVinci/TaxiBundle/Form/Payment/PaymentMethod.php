<?php

namespace DaVinci\TaxiBundle\Form\Payment;

abstract class PaymentMethod 
{
	
	const CLASS_END = 'PaymentMethod';
	
	const POS_PAYPAL_METHOD = 0;
	const POS_SKRILL_METHOD = 1;
	
	const CREDIT_CARD_METHOD = 'CreditCard';
	const PAYPAL_METHOD = 'PayPal';
	const SKRILL_METHOD = 'Skrill';
	
	const MAX_YEAR_PERIOD = 6;
	
	/**
	 * @var string
	 */
	protected $company;
	
	/**
	 * @var srting
	 */
	protected $type;
	
	/**
	 * @var srting
	 */
	protected $ownNote;
	
	public function setCompany($company) 
	{
		$this->company = $company;
		
		return $this;
	}
	
	public function getCompany()
	{
		return $this->company;
	}
	
	public function setOwnNote($ownNote)
	{
		$this->ownNote = $ownNote;
	
		return $this;
	}
	
	public function getOwnNote()
	{
		return $this->ownNote;
	}
		
	public function getType()
	{
		$className = get_class($this);
		return substr($className, strrpos($className, "\\") + 1, strpos($className, self::CLASS_END));
	}
	
}

?>