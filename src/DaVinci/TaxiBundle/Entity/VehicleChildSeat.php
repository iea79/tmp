<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vehicle_child_seat")
 */
class VehicleChildSeat {
	
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
	
	public function setChildSeatType($childSeatType) {
		if (!in_array($childSeatType, array(
			self::CHILD_SEAT_SMALL, 
			self::CHILD_SEAT_MIDDLE_SMALL, 
			self::CHILD_SEAT_MIDDLE_BIG,
			self::CHILD_SEAT_BIG
		))) {
			throw new InvalidArgumentException("Invalid child seat type :: {$childSeatType}");
		}
	
		$this->childSeatType = $childSeatType;
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
     * Get childSeatType
     *
     * @return string 
     */
    public function getChildSeatType()
    {
        return $this->childSeatType;
    }
}
