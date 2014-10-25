<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vehicle")
 */
class Vehicle {
	
	const CLASS_ECONOMY = 'economy';
	const CLASS_COMPACT = 'compact';
	const CLASS_MIDSIZE = 'midsize';
	
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
	
	public function setVehicleClass($vehicleClass) {
		if (!in_array($vehicleClass, array(
			self::CLASS_ECONOMY, self::CLASS_COMPACT, self::CLASS_MIDSIZE
		))) {
			throw new InvalidArgumentException("Invalid vehicle class :: {$vehicleClass}");
		}
		
		$this->vehicleClass = $vehicleClass;
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
}
