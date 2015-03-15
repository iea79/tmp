<?php

namespace DaVinci\TaxiBundle\Form\Payment;

class CreditCardPaymentMethod extends PaymentMethod 
{
	
	const POS_TYPE_VISA = 1;
	const POS_TYPE_MASTER_CARD = 2;
	const POS_TYPE_DINERS_CLUB = 3;
	const POS_TYPE_AMERICAN_EXPRESS = 4;
	
	const CARD_TYPE_VISA = 'Visa';
	const CARD_TYPE_MASTER_CARD = 'Master Card';
	const CARD_TYPE_DINERS_CLUB = 'Diners Club';
	const CARD_TYPE_AMERICAN_EXPRESS = 'American Express';
	
	
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
	protected $firstname;
	
	/**
	 * @var string
	 */
	protected $lastname;
	
	/**
	 * @var string
	 */
	protected $address;
	
	/**
	 * @var string
	 */
	protected $city;
	
	/**
	 * @var string
	 */
	protected $state;
	
	/**
	 * @var string
	 */
	protected $country;
	
	/**
	 * @var array
	 */
	static public $subTypes = array(
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
	
	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;
	
		return $this;
	}
	
	public function getFirstname()
	{
		return $this->firstname;
	}
	
	public function setLastname($lastname)
	{
		$this->lastname = $lastname;
	
		return $this;
	}
	
	public function getLastname()
	{
		return $this->lastname;
	}
	
	public function setAddress($address)
	{
		$this->address = $address;
	
		return $this;
	}
	
	public function getAddress()
	{
		return $this->address;
	}
	
	public function setCity($city)
	{
		$this->city = $city;
	
		return $this;
	}
	
	public function getCity()
	{
		return $this->city;
	}
	
	public function setState($state)
	{
		$this->state = $state;
	
		return $this;
	}
	
	public function getState()
	{
		return $this->state;
	}
	
	public function setCountry($country)
	{
		$this->country = $country;
	
		return $this;
	}
	
	public function getCountry()
	{
		return $this->country;
	}
			
}

?>