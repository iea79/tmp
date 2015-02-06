<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="vehicle_options")
 */
class VehicleOptions {
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var ArrayCollection
	 */
	private $childSeats;
	
	/**
	 * @var ArrayCollection
	 */
	private $petCages;
	
	/**
	 * @ORM\Column(type="integer", name="cycle_rack")
	 */
	private $cycleRack = 0;
	
	/**
	 * @ORM\Column(type="integer", name="ski_rack")
	 */
	private $skiRack = 0;
	
	/**
	 * @ORM\Column(type="integer", name="stroller_place")
	 */
	private $strollerPlace = 0;
	
	/**
	 * @ORM\Column(type="integer", name="wheel_chair_place")
	 */
	private $wheelChairPlace = 0;
	
	/**
	 * @ORM\Column(type="boolean", name="roof_rack")
	 */
	private $roofRack = false;
	
	/**
	 * @ORM\Column(type="boolean", name="trailer")
	 */
	private $trailer = false;
	
	/**
	 * @ORM\OneToOne(targetEntity="PassengerRequest")
	 * @ORM\JoinColumn(name="request_id", referencedColumnName="id")
	 */
	private $passengerRequest;
	
	public function __construct() {
		$this->childSeats = new ArrayCollection();
		$this->petCages = new ArrayCollection();
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
     * Set cycleRack
     *
     * @param integer $cycleRack
     * @return VehicleOptions
     */
    public function setCycleRack($cycleRack)
    {
        $this->cycleRack = $cycleRack;

        return $this;
    }

    /**
     * Get cycleRack
     *
     * @return integer 
     */
    public function getCycleRack()
    {
        return $this->cycleRack;
    }

    /**
     * Set skiRack
     *
     * @param integer $skiRack
     * @return VehicleOptions
     */
    public function setSkiRack($skiRack)
    {
        $this->skiRack = $skiRack;

        return $this;
    }

    /**
     * Get skiRack
     *
     * @return integer 
     */
    public function getSkiRack()
    {
        return $this->skiRack;
    }

    /**
     * Set strollerPlace
     *
     * @param integer $strollerPlace
     * @return VehicleOptions
     */
    public function setStrollerPlace($strollerPlace)
    {
        $this->strollerPlace = $strollerPlace;

        return $this;
    }

    /**
     * Get strollerPlace
     *
     * @return integer 
     */
    public function getStrollerPlace()
    {
        return $this->strollerPlace;
    }

    /**
     * Set wheelChairPlace
     *
     * @param integer $wheelChairPlace
     * @return VehicleOptions
     */
    public function setWheelChairPlace($wheelChairPlace)
    {
        $this->wheelChairPlace = $wheelChairPlace;

        return $this;
    }

    /**
     * Get wheelChairPlace
     *
     * @return integer 
     */
    public function getWheelChairPlace()
    {
        return $this->wheelChairPlace;
    }

    /**
     * Set roofRack
     *
     * @param boolean $roofRack
     * @return VehicleOptions
     */
    public function setRoofRack($roofRack)
    {
        $this->roofRack = $roofRack;

        return $this;
    }

    /**
     * Get roofRack
     *
     * @return boolean 
     */
    public function getRoofRack()
    {
        return $this->roofRack;
    }

    /**
     * Set trailer
     *
     * @param boolean $trailer
     * @return VehicleOptions
     */
    public function setTrailer($trailer)
    {
        $this->trailer = $trailer;

        return $this;
    }

    /**
     * Get trailer
     *
     * @return boolean 
     */
    public function getTrailer()
    {
        return $this->trailer;
    }

    /**
     * Add childSeats
     *
     * @param \DaVinci\TaxiBundle\Entity\VehicleChildSeat $childSeat
     * @return VehicleOptions
     */
    public function addChildSeat(\DaVinci\TaxiBundle\Entity\VehicleChildSeat $childSeat)
    {
        $this->childSeats[] = $childSeat;

        return $this;
    }

    /**
     * Remove childSeats
     *
     * @param \DaVinci\TaxiBundle\Entity\VehicleChildSeat $childSeats
     */
    public function removeChildSeat(\DaVinci\TaxiBundle\Entity\VehicleChildSeat $childSeat)
    {
        $this->childSeats->removeElement($childSeat);
    }

    /**
     * Get childSeats
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildSeats()
    {
        return $this->childSeats;
    }

    /**
     * Add petCages
     *
     * @param \DaVinci\TaxiBundle\Entity\VehiclePetCage $petCages
     * @return VehicleOptions
     */
    public function addPetCage(\DaVinci\TaxiBundle\Entity\VehiclePetCage $petCage)
    {
        $this->petCages[] = $petCage;

        return $this;
    }

    /**
     * Remove petCages
     *
     * @param \DaVinci\TaxiBundle\Entity\VehiclePetCage $petCages
     */
    public function removePetCage(\DaVinci\TaxiBundle\Entity\VehiclePetCage $petCage)
    {
        $this->petCages->removeElement($petCages);
    }

    /**
     * Get petCages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPetCages()
    {
        return $this->petCages;
    }

    /**
     * Set passengerRequest
     *
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
     * @return VehicleOptions
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
