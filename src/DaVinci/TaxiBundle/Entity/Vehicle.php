<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vehicle")
 */
class Vehicle {
	
	const POS_DEFAULT = 0;
	const POS_CLASS_ECONOMY = 1;
	const POS_CLASS_COMPACT = 2;
	const POS_CLASS_MIDSIZE = 3;
	const POS_CLASS_STANDART = 4;
	const POS_CLASS_FULL_SIZE = 5;
	const POS_CLASS_PREMIUM = 6;
	const POS_CLASS_MIDSIZE_SUV = 7;
	const POS_CLASS_STANDART_CONVERTIBLE = 8;
	const POS_CLASS_PREMIUM_PICKUP = 9;
	const POS_CLASS_MINI_VAN = 10;
	const POS_CLASS_STANDART_SUV = 11;
	const POS_CLASS_STANDART_VAN = 12;
	const POS_CLASS_FULL_SIZE_PICKUP = 13;
	const POS_CLASS_FULL_SIZE_SUV = 14;
	const POS_CLASS_STANDART_PICKUP = 15;
	const POS_CLASS_FULL_SIZE_VAN = 16;
	const POS_CLASS_SPECIAL_VAN = 17;
	const POS_CLASS_PREMIUM_VAN = 18;
	const POS_CLASS_LUXURY = 19;
	const POS_CLASS_PREMIUM_SPECIAL = 20;
	const POS_CLASS_PREMIUM_SUV = 21;
	const POS_CLASS_SPECIAL = 22;
	
	const CLASS_DEFAULT = 'Not chosen';
	const CLASS_ECONOMY = 'Economy';
	const CLASS_COMPACT = 'Compact';
	const CLASS_MIDSIZE = 'Midsize';
	const CLASS_STANDART = 'Standart';
	const CLASS_FULL_SIZE = 'Full Size';
	const CLASS_PREMIUM = 'Premium'; 
	const CLASS_MIDSIZE_SUV = 'Midsize SUV';
	const CLASS_STANDART_CONVERTIBLE = 'Standart Convertible';
	const CLASS_PREMIUM_PICKUP = 'Premium Pickup'; 
	const CLASS_MINI_VAN = 'Mini Van'; 
	const CLASS_STANDART_SUV = 'Standart SUV';
	const CLASS_STANDART_VAN = 'Standart Van';
	const CLASS_FULL_SIZE_PICKUP = 'Full Size Pickup';
	const CLASS_FULL_SIZE_SUV = 'Full Size SUV';
	const CLASS_STANDART_PICKUP = 'Standart Pickup';
	const CLASS_FULL_SIZE_VAN = 'Full Size Van';
	const CLASS_SPECIAL_VAN = 'Special Van';
	const CLASS_PREMIUM_VAN = 'Premium Van';
	const CLASS_LUXURY = 'Luxury';
	const CLASS_PREMIUM_SPECIAL = 'Premium Special';
	const CLASS_PREMIUM_SUV = 'Premium SUV';
	const CLASS_SPECIAL = 'Special';
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", columnDefinition="ENUM('economy', 'compact', 'midsize')", name="vehicle_class", length=255)
	 */
	private $vehicleClass;
	
	/**
	 * @ORM\Column(type="string", name="special_requirements", length=255)
	 */
	private $specialRequirements;
	
	/**
	 * @ORM\OneToOne(targetEntity="PassengerRequest", inversedBy="vehicle")
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
     * Set vehicleClass
     *
     * @param string $vehicleClass
     * @throws \InvalidArgumentException
     * @return \DaVinci\TaxiBundle\Entity\Vehicle
     */
    public function setVehicleClass($vehicleClass) {
    	if (!in_array($vehicleClass, self::getChoices())) {
    		throw new \InvalidArgumentException("Invalid vehicle class :: {$vehicleClass}");
    	}
    
    	$this->vehicleClass = $vehicleClass;
    	
    	return $this;
    }
    
    /**
     * Get vehicleClass
     *
     * @return string 
     */
    public function getVehicleClass()
    {
        return $this->vehicleClass;
    }

    /**
     * Set specialRequirements
     *
     * @param string $specialRequirements
     * @return Vehicle
     */
    public function setSpecialRequirements($specialRequirements)
    {
        $this->specialRequirements = $specialRequirements;

        return $this;
    }

    /**
     * Get specialRequirements
     *
     * @return string 
     */
    public function getSpecialRequirements()
    {
        return $this->specialRequirements;
    }

    /**
     * Set passengerRequest
     *
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
     * @return Vehicle
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
    
    public static function getChoices()
    {
    	return array(
    		self::POS_DEFAULT => self::CLASS_DEFAULT,
    		self::POS_CLASS_ECONOMY => self::CLASS_ECONOMY,
    		self::POS_CLASS_COMPACT => self::CLASS_COMPACT,
    		self::POS_CLASS_MIDSIZE => self::CLASS_MIDSIZE,
    		self::POS_CLASS_STANDART => self::CLASS_STANDART,
    		self::POS_CLASS_FULL_SIZE => self::CLASS_FULL_SIZE,
    		self::POS_CLASS_PREMIUM => self::CLASS_PREMIUM,
    		self::POS_CLASS_MIDSIZE_SUV => self::CLASS_MIDSIZE_SUV,
    		self::POS_CLASS_STANDART_CONVERTIBLE => self::CLASS_STANDART_CONVERTIBLE,
    		self::POS_CLASS_PREMIUM_PICKUP => self::CLASS_PREMIUM_PICKUP,
    		self::POS_CLASS_MINI_VAN => self::CLASS_MINI_VAN,
    		self::POS_CLASS_STANDART_SUV => self::CLASS_STANDART_SUV,
    		self::POS_CLASS_STANDART_VAN => self::CLASS_STANDART_VAN,
    		self::POS_CLASS_FULL_SIZE_PICKUP => self::CLASS_FULL_SIZE_PICKUP,
    		self::POS_CLASS_FULL_SIZE_SUV => self::CLASS_FULL_SIZE_SUV,
    		self::POS_CLASS_STANDART_PICKUP => self::CLASS_STANDART_PICKUP,
    		self::POS_CLASS_FULL_SIZE_VAN => self::CLASS_FULL_SIZE_VAN,
    		self::POS_CLASS_SPECIAL_VAN => self::CLASS_SPECIAL_VAN,
    		self::POS_CLASS_PREMIUM_VAN => self::CLASS_PREMIUM_VAN,
    		self::POS_CLASS_LUXURY => self::CLASS_LUXURY,
    		self::POS_CLASS_PREMIUM_SPECIAL => self::CLASS_PREMIUM_SPECIAL,
    		self::POS_CLASS_PREMIUM_SUV => self::CLASS_PREMIUM_SUV,
    		self::POS_CLASS_SPECIAL => self::CLASS_SPECIAL
    	);
    }
    
}
