<?php

namespace DaVinci\TaxiBundle\Form\Payment;

class CreditCardPaymentMethod extends PaymentMethod 
{
	
	const POS_TYPE_VISA = 0;
	const POS_TYPE_MASTER_CARD = 1;
	const POS_TYPE_DINERS_CLUB = 2;
	const POS_TYPE_AMERICAN_EXPRESS = 3;
	
	const CARD_TYPE_VISA = 'Visa';
	const CARD_TYPE_MASTER_CARD = 'MasterCard';
	const CARD_TYPE_DINERS_CLUB = 'DinersClub';
	const CARD_TYPE_AMERICAN_EXPRESS = 'AmericanExpress';
	
	
	/**
	 * @var string
	 */
	protected $cardNumber;
	
	/**
	 * @var string
	 */
	protected $secretSalt;
	
	/**
	 * @var string
	 */
	protected $expirationMounth;
	
	/**
	 * @var string
	 */
	protected $expirationYear;
	
	/**
	 * @var string
	 */
	protected $methodType;
	
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var string
	 */
	protected $surname;
	
	/**
	 * @var array
	 */
	static public $cardTypes = array(
		self::POS_TYPE_VISA => self::CARD_TYPE_VISA,
		self::POS_TYPE_MASTER_CARD => self::CARD_TYPE_MASTER_CARD,
		self::POS_TYPE_DINERS_CLUB => self::CARD_TYPE_DINERS_CLUB,
		self::POS_TYPE_AMERICAN_EXPRESS => self::CARD_TYPE_AMERICAN_EXPRESS			
	);

	public function setCardNumber($cardNumber)
	{
		$this->cardNumber = $cardNumber;
	
		return $this;
	}
	
	public function getCardNumber()
	{
		return $this->cardNumber;
	}
	
	public function setSecretSalt($secretSalt)
	{
		$this->secretSalt = $secretSalt;
	
		return $this;
	}
	
	public function getSecretSalt()
	{
		return $this->secretSalt;
	}
	
	public function setExpirationMonth($expirationMounth)
	{
		$this->expirationMounth = $expirationMounth;
	
		return $this;
	}
	
	public function getExpirationMonth()
	{
		return $this->expirationMounth;
	}
	
	public function setExpirationYear($expirationYear)
	{
		$this->expirationYear = $expirationYear;
	
		return $this;
	}
	
	public function getExpirationYear()
	{
		return $this->expirationYear;
	}
	
	public function setMethodType($methodType)
	{
		if (!array_key_exists($methodType, self::$cardTypes)) {
			throw new \InvalidArgumentException("Unsupported card type code: {$methodType}");
		}
		$this->methodType = $methodType;
	
		return $this;
	}
	
	public function getMethodType()
	{
		return $this->methodType;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	
		return $this;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setSurname($surname)
	{
		$this->surname = $surname;
	
		return $this;
	}
	
	public function getSurname()
	{
		return $this->surname;
	}
	
	static public function getCardTypes()
	{
		return self::$cardTypes; 
	}
	
}

?>