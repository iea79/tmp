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
	const POS_CLASS_LUXURY = 7;
	const POS_CLASS_OTHER = 8;
	const POS_CLASS_CONVERTIBLE = 9;
	const POS_CLASS_VAN = 10;
	const POS_CLASS_SUV = 11;
	const POS_CLASS_SPECIALITY = 12;
	const POS_CLASS_PICKUP = 13;
	
	const CLASS_DEFAULT = 'Not chosen';
	const CLASS_ECONOMY = 'Economy';
	const CLASS_COMPACT = 'Compact';
	const CLASS_MIDSIZE = 'Midsize';
	const CLASS_STANDART = 'Standart';
	const CLASS_FULL_SIZE = 'Full Size';
	const CLASS_PREMIUM = 'Premium'; 
	const CLASS_LUXURY = 'Luxury';
	const CLASS_OTHER = 'Other';
	const CLASS_CONVERTIBLE = 'Convertible';
	const CLASS_VAN = 'Van';
	const CLASS_SUV = 'SUV';
	const CLASS_SPECIALITY = 'Speciality';
	const CLASS_PICKUP = 'Pickup';
		
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", columnDefinition="ENUM('Not chosen', 'Economy', 'Compact', 'Midsize', 'Standart', 'Full Size', 'Premium', 'Luxury', 'Other', 'Convertible', 'Speciality', 'Pickup')", name="vehicle_class", length=100)
	 */
	private $vehicleClass;
	
	/**
	 * @ORM\Column(type="string", name="special_requirements", length=255, nullable=true)
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
    	$choices = self::getChoices();    	
    	if (!array_key_exists($vehicleClass, $choices)) {
    		throw new \InvalidArgumentException("Invalid vehicle class :: {$vehicleClass}");
    	}
    
    	$this->vehicleClass = $choices[$vehicleClass];
    	
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
    		self::POS_CLASS_LUXURY => self::CLASS_LUXURY,
    		self::POS_CLASS_OTHER => self::CLASS_OTHER,
    		self::POS_CLASS_CONVERTIBLE => self::CLASS_CONVERTIBLE,
    		self::POS_CLASS_VAN => self::CLASS_VAN,
    		self::POS_CLASS_SUV => self::CLASS_SUV,
    		self::POS_CLASS_SPECIALITY => self::CLASS_SPECIALITY,
    		self::POS_CLASS_PICKUP => self::CLASS_PICKUP
    	);
    }
    
}
