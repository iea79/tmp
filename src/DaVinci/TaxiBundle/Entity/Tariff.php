<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="tariff")
 */
class Tariff {
	
	const MAIN_PAYMENT = 'price';
	const TIPS_PAYMENT = 'tips';
	
	const POS_PAYMENT_METHOD_CASH = 0;
	const POS_PAYMENT_METHOD_ESCROW = 1;
	
	const PAYMENT_METHOD_CASH = 'cash';
	const PAYMENT_METHOD_ESCROW = 'escrow';
	
	const PRICE_TYPE_YOUR = 'your';
	const PRICE_TYPE_MARKET = 'market';
		
	const POS_PRICE_TYPE_YOUR = 0;
	const POS_PRICE_TYPE_MARKET = 1;
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="float")
	 */
	private $price = 0.00;
	
	/**
	 * @var float
	 */
	private $marketPrice;
	
	/**
	 * @var float
	 */
	private $yourPrice;
	
	/**
	 * @var string
	 */
	private $priceType;
	
	/**
	 * @ORM\Column(type="float")
	 */
	private $tips = 0.00;
	
	/**
	 * @var float
	 */
	private $marketTips;
	
	/**
	 * @var float
	 */
	private $yourTips;
	
	/**
	 * @var string
	 */
	private $tipsType;
	
	/**
	 * @ORM\Column(type="string", columnDefinition="ENUM('cash', 'escrow')", name="price_payment_method", length=15)
	 */
	private $pricePaymentMethod;
	
	/**
	 * @ORM\Column(type="string", columnDefinition="ENUM('cash', 'escrow')", name="tips_payment_method", length=15)
	 */
	private $tipsPaymentMethod;
	
	/**
	 * @ORM\OneToOne(targetEntity="PassengerRequest", inversedBy="tariff")
	 * @ORM\JoinColumn(name="request_id", referencedColumnName="id")
	 */
	private $passengerRequest;
	
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
     * Set price
     *
     * @param float $price
     * @return Tariff
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set tips
     *
     * @param float $tips
     * @return Tariff
     */
    public function setTips($tips)
    {
        $this->tips = $tips;

        return $this;
    }

    /**
     * Get tips
     *
     * @return float 
     */
    public function getTips()
    {
        return $this->tips;
    }
    
    /**
     * Set pricePaymentMethod
     * 
     * @param string $paymentMethod
     * @throws \InvalidArgumentException
     * @return \DaVinci\TaxiBundle\Entity\Tariff
     */
    public function setPricePaymentMethod($paymentMethod) {
    	$methods = self::getPaymentMethods();
    	
    	$this->checkPaymentMethod($paymentMethod, self::MAIN_PAYMENT);
       	$this->pricePaymentMethod = $methods[$paymentMethod];
    	
    	return $this;
    }
    
    /**
     * Get pricePaymentMethod
     *
     * @return string
     */
    public function getPricePaymentMethod()
    {
    	return $this->pricePaymentMethod;
    }
    
    public function setMarketPrice($price)
    {
    	$this->marketPrice = $price;
    	
    	return $this;
    }
    
    public function getMarketPrice()
    {
    	 return $this->marketPrice;
    }
    
    public function setYourPrice($price)
    {
    	$this->yourPrice = $price;
    	
    	return $this;
    }
    
    public function getYourPrice()
    {
    	return $this->yourPrice;
    }
    
    public function setPriceType($priceType)
    {
    	if (!array_key_exists($priceType, self::getTypes())) {
    		throw new \InvalidArgumentException("Invalid price type :: {$priceType}");
    	}
    	$this->priceType = $priceType;
    	
    	return $this;
    }
    
    public function getPriceType()
    {
    	return $this->priceType;
    }
        
    /**
     * Set pricePaymentMethod
     *
     * @param string $paymentMethod
     * @throws \InvalidArgumentException
     * @return \DaVinci\TaxiBundle\Entity\Tariff
     */
    public function setTipsPaymentMethod($paymentMethod) {
    	$methods = self::getPaymentMethods();
    	
    	$this->checkPaymentMethod($paymentMethod, self::TIPS_PAYMENT);
       	$this->tipsPaymentMethod = $methods[$paymentMethod];
    	 
    	return $this;
    }
    
    /**
     * Get pricePaymentMethod
     *
     * @return string
     */
    public function getTipsPaymentMethod()
    {
    	return $this->tipsPaymentMethod;
    }
    
    public function setMarketTips($tips)
    {
    	$this->marketTips = $tips;
    	
    	return $this;
    }
    
    public function getMarketTips()
    {
    	return $this->marketTips;
    }
    
    public function setYourTips($tips)
    {
    	$this->yourTips = $tips;
    	
    	return $this;
    }
    
    public function getYourTips()
    {
    	return $this->yourTips;
    }
    
    public function setTipsType($tipsType)
    {
    	if (!array_key_exists($tipsType, self::getTypes())) {
    		throw new \InvalidArgumentException("Invalid tips type :: {$tipsType}");
    	}
    	$this->tipsType = $tipsType;
    	 
    	return $this;
    }
    
    public function getTipsType()
    {
    	return $this->tipsType;
    }
    
    /**
     * Set passengerRequest
     *
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
     * @return Tariff
     */
    public function setPassengerRequest(\DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest = null)
    {
        $this->passengerRequest = $passengerRequest;

        return $this;
    }

    /**
     * Get passengerRequest
     *
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequest 
     */
    public function getPassengerRequest()
    {
        return $this->passengerRequest;
    }
    
    public function definePrice()
    {
    	$this->price = ($this->yourPrice > 0 && $this->priceType == self::POS_PRICE_TYPE_YOUR) 
    		? $this->yourPrice 
    		: $this->marketPrice;
    }
    
    public function defineTips()
    {
    	$this->tips = ($this->tipsType == self::POS_PRICE_TYPE_YOUR) 
    		? $this->yourTips 
    		: $this->marketTips;
    }

    public function getTotalPrice()
    {
    	return $this->price + $this->tips;
    }
    
    public static function getPaymentMethods()
    {
    	return array(
    		self::POS_PAYMENT_METHOD_CASH => self::PAYMENT_METHOD_CASH,
    		self::POS_PAYMENT_METHOD_ESCROW => self::PAYMENT_METHOD_ESCROW
    	);
    }
    
    public static function getTypes()
    {
    	return array(
    		self::POS_PRICE_TYPE_YOUR => self::PRICE_TYPE_YOUR,
    		self::POS_PRICE_TYPE_MARKET => self::PRICE_TYPE_MARKET
    	);
    }
    
    private function checkPaymentMethod($paymentMethod, $type)
    {
    	if (!array_key_exists($paymentMethod, self::getPaymentMethods())) {
    		throw new \InvalidArgumentException("Undefined {$type} payment method :: {$paymentMethod}");
    	}
    }
    
}
