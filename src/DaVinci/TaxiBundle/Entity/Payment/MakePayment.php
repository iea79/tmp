<?php

namespace DaVinci\TaxiBundle\Entity\Payment;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DaVinci\TaxiBundle\Entity\Money;

/**
 * @ORM\Entity(repositoryClass="MakePaymentRepository")
 * @ORM\Table(name="payment_operation")
 */
class MakePayment 
{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
		
	/**
	 * @ORM\ManyToOne(targetEntity="PaymentMethod", inversedBy="makePayments")
	 * @ORM\JoinColumn(name="payment_method_id", referencedColumnName="id")
	 * @Assert\Valid()
	 */
	private $paymentMethod;
	
	/**
	 * @ORM\Column(type="string", name="payment_method_code")
	 */
	private $paymentMethodCode;
		
	/**
	 * @ORM\Column(type="float")
	 */
	private $amount = 0.00;
	
	/**
	 * @ORM\Column(type="string", length=3)
	 */
	private $currency;
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\Payment\Money
	 */
	private $totalPrice;
	
	/**
	 * @ORM\ManyToOne(targetEntity="\DaVinci\TaxiBundle\Entity\User")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	private $user;
	
	/**
	 * @ORM\Column(type="string")
	 */
	private $description;
		
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
	 * Set paymentMethod
	 * 
	 * @param \DaVinci\TaxiBundle\Entity\Payment\PaymentMethod $paymentMethod
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePayment
	 */
	public function setPaymentMethod(\DaVinci\TaxiBundle\Entity\Payment\PaymentMethod $paymentMethod)
	{
		$this->paymentMethod = $paymentMethod;
	
		return $this;
	}
	
	/**
	 * Get paymentMethod
	 * 
	 * @return \DaVinci\TaxiBundle\Entity\Payment\PaymentMethod
	 */
	public function getPaymentMethod()
	{
		return $this->paymentMethod;
	}
	
	/**
	 * Set paymentMethodCode
	 * 
	 * @param string $paymentMethodCode
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePayment
	 */
	public function setPaymentMethodCode($paymentMethodCode)
	{
		$this->paymentMethodCode = $paymentMethodCode;
	
		return $this;
	}
	
	/**
	 * Get paymentMethodCode
	 *
	 * @return string
	 */
	public function getPaymentMethodCode()
	{
		return $this->paymentMethodCode;
	}

	/**
	 * Set totalPrice
	 * 
	 * @param \DaVinci\TaxiBundle\Entity\Money $totalPrice
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePayment
	 */
	public function setTotalPrice(\DaVinci\TaxiBundle\Entity\Money $totalPrice)
	{
		$this->totalPrice = $totalPrice;
		
		$this->amount = $totalPrice->getAmount();
		$this->currency = $totalPrice->getCurrency();
	
		return $this;
	}
	
	/**
	 * Get totalPrice
	 * 
	 * @return \DaVinci\TaxiBundle\Entity\Money $totalPrice
	 */
	public function getTotalPrice()
	{
		$totalPrice = new Money();
		$totalPrice->setAmount($this->amount);
		$totalPrice->setCurrency($this->currency);
		
		$this->totalPrice = $totalPrice; 
		
		return $this->totalPrice;
	}
	
	/**
	 * Set amount
	 * 
	 * @param float $amount
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePayment
	 */
	public function setAmount($amount)
	{
		$this->amount = $amount;
		
		return $this;
	}
	
	/**
	 * Get amount
	 *
	 * @return float
	 */
	public function getAmount()
	{
		return $this->amount;
	}
	
	/**
	 * Set currency
	 *
	 * @param string $currency
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePayment
	 */
	public function setCurrency($currency)
	{
		$this->currency = $currency;
	
		return $this;
	}
	
	/**
	 * Get currency
	 *
	 * @return string
	 */
	public function getCurrency()
	{
		return $this->currency;
	}
				

    /**
     * Set user
     *
     * @param \DaVinci\TaxiBundle\Entity\User $user
     *
     * @return MakePayment
     */
    public function setUser(\DaVinci\TaxiBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \DaVinci\TaxiBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * @return \DaVinci\TaxiBundle\Entity\Payment\MakePayment
     */
    public function setDefaultTotalPrice()
    {
    	$this->amount = MakePayments::DEFAULT_REQUEST_PRICE;
    	$this->currency = MakePayments::DEFAULT_CURRENCY;
    	
    	return $this;
    }
    

    /**
     * Set description
     *
     * @param string $description
     *
     * @return MakePayment
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
}
