<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="vehicle_child_seat")
 */
class VehicleChildSeat {
	
	const POS_CHILD_SEAT_SMALL = 1;
	const POS_CHILD_SEAT_MIDDLE_SMALL = 2;
	const POS_CHILD_SEAT_MIDDLE_BIG = 3;
	const POS_CHILD_SEAT_BIG = 4;
	
	const CHILD_SEAT_SMALL = '0-12 months';
	const CHILD_SEAT_MIDDLE_SMALL = '1-3 years';
	const CHILD_SEAT_MIDDLE_BIG = '4-7 years';
	const CHILD_SEAT_BIG = '8-12 years';

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
		
	/**
	 * @ORM\Column(type="integer", name="child_seat_number")
	 */
	private $childSeatNumber = 0;
		
	/**
	 * @ORM\Column(type="string", columnDefinition="ENUM('0-12 months', '1-3 years', '4-7 years', '8-12 years')", name="child_seat_type", length=20)
	 */
	private $childSeatType;
	
	/**
     * @ORM\ManyToOne(targetEntity="VehicleOptions", inversedBy="childSeats")
     * @ORM\JoinColumn(name="option_id", referencedColumnName="id")
     */
	private $vehicleOptions;
	
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
     * Set childSeatNumber
     *
     * @param integer $childSeatNumber
     * @return VehicleChildSeat
     */
    public function setChildSeatNumber($childSeatNumber)
    {
        $this->childSeatNumber = $childSeatNumber;

        return $this;
    }

    /**
     * Get childSeatNumber
     *
     * @return integer 
     */
    public function getChildSeatNumber()
    {
        return $this->childSeatNumber;
    }
    
    /**
     * Add vehicleOptions
     *
     * @param \DaVinci\TaxiBundle\Entity\VehicleOptions $vehicleOptions
     * @return \DaVinci\TaxiBundle\Entity\VehicleChildSeat
     */
    public function setVehicleOptions(\DaVinci\TaxiBundle\Entity\VehicleOptions $vehicleOptions)
    {
    	$this->vehicleOptions = $vehicleOptions;
    
    	return $this;
    }
    
    /**
     * Get vehicleOptions
     *
     * @return \DaVinci\TaxiBundle\Entity\VehicleOptions
     */
    public function getVehicleOptions()
    {
    	return $this->vehicleOptions;
    }
    
    /**
     * Set childSeatType
     * 
     * @param string $childSeatType
     * @throws \InvalidArgumentException
     * @return \DaVinci\TaxiBundle\Entity\VehicleChildSeat
     */
    public function setChildSeatType($childSeatType) {
    	$choices = self::getChoices();
    	
    	if (!array_key_exists($childSeatType, $choices)) {
    		throw new \InvalidArgumentException("Invalid child seat type :: {$childSeatType}");
    	}
    
    	$this->childSeatType = $choices[$childSeatType];
    	
    	return $this;
    }

    /**
     * Get childSeatType
     *
     * @return string 
     */
    public function getChildSeatType()
    {
        return array_search($this->childSeatType, self::getChoices());
    }
    
    /**
     * Get childSeatType
     *
     * @return string
     */
    public function getChildSeatTypeName()
    {
    	return $this->childSeatType;
    }
    
    public static function getChoices() 
    {
    	return array(
    		self::POS_CHILD_SEAT_SMALL=> self::CHILD_SEAT_SMALL,
    		self::POS_CHILD_SEAT_MIDDLE_SMALL => self::CHILD_SEAT_MIDDLE_SMALL,
    		self::POS_CHILD_SEAT_MIDDLE_BIG => self::CHILD_SEAT_MIDDLE_BIG,
    		self::POS_CHILD_SEAT_BIG => self::CHILD_SEAT_BIG			
    	);
    }
    
}
