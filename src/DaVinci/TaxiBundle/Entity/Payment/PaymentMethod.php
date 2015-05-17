<?php

namespace DaVinci\TaxiBundle\Entity\Payment;

abstract class PaymentMethod 
{
	
	const CLASS_END = 'PaymentMethod';
	
	const POS_INTERNAL_PAYMENT_METHOD = 1;
	const POS_CREDIT_CARD_METHOD = 2;
	const POS_PAYPAL_METHOD = 3;
	const POS_SKRILL_METHOD = 4;
	
	const INTERNAL_PAYMENT_METHOD = 'Internal';
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
	 * @var string
	 */
	protected $subType;
	
	/**
	 * @var srting
	 */
	protected $ownNote;
	
	/**
	 * @var array
	 */
	static protected $subTypes = array();

	/**
	 * @var array
	 */
	static private $types = array(
		self::POS_INTERNAL_PAYMENT_METHOD => self::INTERNAL_PAYMENT_METHOD,
		self::POS_CREDIT_CARD_METHOD => self::CREDIT_CARD_METHOD,
		self::POS_PAYPAL_METHOD => self::PAYPAL_METHOD,
		self::POS_SKRILL_METHOD => self::SKRILL_METHOD			
	);
	
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
		$this->type = substr(
			$className, strrpos($className, "\\") + 1, strpos($className, self::CLASS_END)
		);
		
		return $this->type;
	}
	
	static public function getTypeByCode($code)
	{
		if (!array_key_exists($code, static::$types)) {
			throw new \InvalidArgumentException("Unsupported type code: {$code}");
		}
		
		return self::$types[$code];
	}
	
	static public function getTypes()
	{
		return self::$types;
	}
			
	public function setSubType($subType)
	{
		if (!array_key_exists($subType, static::$subTypes)) {
			throw new \InvalidArgumentException("Unsupported subtype code: {$subType}");
		}
		$this->subType = $subType;
	
		return $this;
	}
	
	public function getSubType()
	{
		return $this->subType;
	}
	
	static public function getSubTypes()
	{
		return static::$subTypes;
	}
	
	public function getSubTypeName()
	{
		if (!$this->subType) {
			return null;
		}
	
		return static::$subTypes[$this->subType];
	}
	
}

?>