<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vehicle_pet_cage")
 */
class VehiclePetCage {
	
	const POS_PET_CAGE_SMALL = 1;
	const POS_PET_CAGE_MIDDLE = 2;
	const POS_PET_CAGE_BIG = 3;
	
	const PET_CAGE_SMALL = '10 pounds';
	const PET_CAGE_MIDDLE = '50 pounds';
	const PET_CAGE_BIG = '100 pounds';

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
		
	/**
	 * @ORM\Column(type="integer", name="pet_cage_number")
	 */
	private $petCageNumber = 0;
		
	/**
	 * @ORM\Column(type="string", columnDefinition="ENUM('10 pounds', '50 pounds', '100 pounds')", name="pet_cage_type", length=20)
	 */
	private $petCageType;
	
	/**
     * @ORM\ManyToOne(targetEntity="VehicleOptions", inversedBy="petCages")
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
     * Set petCageNumber
     *
     * @param integer $petCageNumber
     * @return VehiclePetCage
     */
    public function setPetCageNumber($petCageNumber)
    {
        $this->petCageNumber = $petCageNumber;

        return $this;
    }

    /**
     * Get petCageNumber
     *
     * @return integer 
     */
    public function getPetCageNumber()
    {
        return $this->petCageNumber;
    }
    
    /**
     * Set petCageType
     * 
     * @param string $petCageType
     * @throws \InvalidArgumentException
     * @return \DaVinci\TaxiBundle\Entity\VehiclePetCage
     */
    public function setPetCageType($petCageType) {
    	$choices = self::getChoices();
    	
    	if (!array_key_exists($petCageType, $choices)) {
    		throw new \InvalidArgumentException("Invalid pet cage type :: {$petCageType}");
    	}
    
    	$this->petCageType = $choices[$petCageType];
    	
    	return $this;
    }

    /**
     * Get petCageType
     *
     * @return string 
     */
    public function getPetCageType()
    {
        return array_search($this->petCageType, self::getChoices());
    }

    /**
     * Get petCageType
     *
     * @return string
     */
    public function getPetCageTypeName()
    {
    	return $this->petCageType;
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
    
    public static function getChoices()
    {
    	return array(
    		self::POS_PET_CAGE_SMALL => self::PET_CAGE_SMALL,
    		self::POS_PET_CAGE_MIDDLE => self::PET_CAGE_MIDDLE,
    		self::POS_PET_CAGE_BIG => self::PET_CAGE_BIG		
    	);
    }
    
}
