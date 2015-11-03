<?php

namespace DaVinci\TaxiBundle\Entity\Payment;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="payment_method")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(type="string", name="method_type")
 * @ORM\DiscriminatorMap({
 * 		"method_credit_card"="CreditCardPaymentMethod", 
 * 		"method_pay_pal"="PayPalPaymentMethod", 
 * 		"method_internal"="InternalPaymentMethod",
 * 		"method_skrill"="SkrillPaymentMethod"
 * })
 */
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
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * @var ArrayCollection
	 * @ORM\OneToMany(targetEntity="MakePayment", mappedBy="paymentMethod")
	 */ 
	protected $makePayments;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $company;
	
	/**
	 * @var string
	 */
	protected $type;
	
	/**
	 * @ORM\Column(type="integer", name="sub_type")
	 */
	protected $subType = 0;
	
	/**
	 * @ORM\Column(type="string", name="own_note", length=255, nullable=true)
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
	
	public function __construct()
	{
		$this->makePayments = new ArrayCollection();
	}
	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Add makePayment
	 *
	 * @param \DaVinci\TaxiBundle\Entity\Payment\MakePayment $makePayment
	 *
	 * @return PaymentMethod
	 */
	public function addMakePayment(\DaVinci\TaxiBundle\Entity\Payment\MakePayment $makePayment)
	{
		$this->makePayments[] = $makePayment;
	
		return $this;
	}
	
	/**
	 * Remove makePayment
	 *
	 * @param \DaVinci\TaxiBundle\Entity\Payment\MakePayment $makePayment
	 */
	public function removeMakePayment(\DaVinci\TaxiBundle\Entity\Payment\MakePayment $makePayment)
	{
		$this->makePayments->removeElement($makePayment);
	}
	
	/**
	 * Get makePayments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getMakePayments()
	{
		return $this->makePayments;
	}
		
	/**
	 * Set company
	 *
	 * @param string $company
	 * @return PaymentMethod
	 */
	public function setCompany($company) 
	{
		$this->company = $company;
		
		return $this;
	}
	
	/**
	 * Get company
	 *
	 * @return string
	 */
	public function getCompany()
	{
		return $this->company;
	}
	
	/**
	 * Set ownNote
	 *
	 * @param string $ownNote
	 * @return PaymentMethod
	 */
	public function setOwnNote($ownNote)
	{
		$this->ownNote = $ownNote;
	
		return $this;
	}
	
	/**
	 * Get ownNote
	 *
	 * @return string
	 */
	public function getOwnNote()
	{
		return $this->ownNote;
	}
	
	/**
	 * Set subType
	 *
	 * @param integer $subType
	 * @return PaymentMethod
	 */
	public function setSubType($subType)
	{
		if (!array_key_exists($subType, static::$subTypes)) {
			throw new \InvalidArgumentException("Unsupported subtype code: {$subType}");
		}
		$this->subType = $subType;
	
		return $this;
	}
	
	/**
	 * Get subType
	 *
	 * @return integer
	 */
	public function getSubType()
	{
		return $this->subType;
	}
	
	/**
	 * @return string
	 */
	public function getSubTypeName()
	{
		if (!$this->subType) {
			return null;
		}
	
		return static::$subTypes[$this->subType];
	}
	
	public function getType()
	{
		$className = get_class($this);
		$position = strrpos($className, "\\") + 1;
		
		$this->type = mb_substr(
			$className, $position, strpos($className, self::CLASS_END) - $position
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
	
	static public function getSubTypes()
	{
		return static::$subTypes;
	}

}

?>