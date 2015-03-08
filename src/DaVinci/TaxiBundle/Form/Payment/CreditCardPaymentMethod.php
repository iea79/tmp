<?php

namespace DaVinci\TaxiBundle\Form\Payment;

class CreditCardPaymentMethod extends PaymentMethod 
{
	
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
	protected $cardType;
	
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
		self::CARD_TYPE_VISA,
		self::CARD_TYPE_MASTER_CARD,
		self::CARD_TYPE_DINERS_CLUB,
		self::CARD_TYPE_AMERICAN_EXPRESS			
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
	
	public function setCardType($cardType)
	{
		if (!array_key_exists($cardType, self::$cardTypes)) {
			throw new \InvalidArgumentException("Unsupported card type code: {$cardType}");
		}
		$this->cardType = $cardType;
	
		return $this;
	}
	
	public function getCardType()
	{
		return $this->cardType;
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