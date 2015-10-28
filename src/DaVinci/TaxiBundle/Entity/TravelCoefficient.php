<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="TravelCoefficientRepository")
 * @ORM\Table(name="travel_coefficient")
 */ 
class TravelCoefficient 
{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", columnDefinition="ENUM('Economy', 'Compact', 'Midsize', 'Standart', 'Full Size', 'Premium', 'Luxury', 'Other', 'Convertible', 'Van', 'SUV', 'Speciality', 'Pickup')", name="vehicle_class", length=100)
	 */
	private $vehicleClass;
	
	/**
	 * @ORM\Column(type="float", name="concrete_value")
	 */
	private $concreteValue;
	
	/**
	 * @ORM\Column(type="float", name="tips_value")
	 */
	private $tipsValue;
		

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
     *
     * @return TravelCoefficient
     */
    public function setVehicleClass($vehicleClass)
    {
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
     * Set concreteValue
     *
     * @param float $concreteValue
     *
     * @return TravelCoefficient
     */
    public function setConcreteValue($concreteValue)
    {
        $this->concreteValue = $concreteValue;

        return $this;
    }

    /**
     * Get concreteValue
     *
     * @return float
     */
    public function getConcreteValue()
    {
        return $this->concreteValue;
    }
    

    /**
     * Set tipsValue
     *
     * @param float $tipsValue
     *
     * @return TravelCoefficient
     */
    public function setTipsValue($tipsValue)
    {
        $this->tipsValue = $tipsValue;

        return $this;
    }

    /**
     * Get tipsValue
     *
     * @return float
     */
    public function getTipsValue()
    {
        return $this->tipsValue;
    }
    
}

?>
