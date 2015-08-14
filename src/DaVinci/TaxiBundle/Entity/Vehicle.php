<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="vehicle")
 */
class Vehicle 
{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", columnDefinition="ENUM('Economy', 'Compact', 'Midsize', 'Standart', 'Full Size', 'Premium', 'Luxury', 'Other', 'Convertible', 'Van', 'SUV', 'Speciality', 'Pickup')", name="vehicle_class", length=100)
	 * @Assert\Choice(
	 * 		groups={"flow_createPassengerRequest_step2"},
	 * 		callback="getPossibleChoices",
	 * 		message="Choose a valid vehicle class"
	 * )
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
    	$choices = VehicleClasses::getChoices();    	
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
    	return array_search($this->vehicleClass, VehicleClasses::getChoices());	
    }
    
    /**
     * Get vehicleClass
     *
     * @return string
     */
    public function getVehicleClassName()
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
    
    public static function getPossibleChoices()
    {
    	return VehicleClasses::getPossibleChoices();
    }
    
}

?>