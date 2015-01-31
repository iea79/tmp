<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="tariff")
 */
class Tariff {
	
	const PAYMENT_METHOD_CASH = 'cash';
	const PAYMENT_METHOD_ESCROW = 'escrow';
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="float")
	 * @Assert\Range(
     *      min = 0.01,
     *      minMessage = "Price must be more than {{ limit }}"
     * )
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
    	$this->checkPaymentMethod($paymentMethod, 'price');
       	$this->pricePaymentMethod = $paymentMethod;
    	
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
    }
    
    public function getMarketPrice()
    {
    	 $this->marketPrice;
    }
    
    public function setYourPrice($price)
    {
    	$this->yourPrice = $price;
    }
    
    public function getYourPrice()
    {
    	$this->yourPrice;
    }
        
    /**
     * Set pricePaymentMethod
     *
     * @param string $paymentMethod
     * @throws \InvalidArgumentException
     * @return \DaVinci\TaxiBundle\Entity\Tariff
     */
    public function setTipsPaymentMethod($paymentMethod) {
    	$this->checkPaymentMethod($paymentMethod, 'tips');
       	$this->tipsPaymentMethod = $paymentMethod;
    	 
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
    }
    
    public function getMarketTips()
    {
    	$this->marketTips;
    }
    
    public function setYourTips($tips)
    {
    	$this->yourTips = $tips;
    }
    
    public function getYourTips()
    {
    	$this->yourTips;
    }
    
    public static function getPaymentMethods()
    {
    	return array(
    		self::PAYMENT_METHOD_CASH,
    		self::PAYMENT_METHOD_ESCROW	
    	);
    }

    public static function getPriceTypes()
    {
    	return array('market_price', 'your_price');
    }
    
    public static function getTipsTypes()
    {
    	return array('market_tips', 'your_tips');
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
        
    private function checkPaymentMethod($paymentMethod, $type)
    {
    	if (!in_array($paymentMethod, self::getPaymentMethods())) {
    		throw new \InvalidArgumentException("Undefined {$type} payment method :: {$paymentMethod}");
    	}
    }
}
