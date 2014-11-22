<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vehicle_services")
 */
class VehicleServices {
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="boolean")
	 */
	private $wifi = false;
	
	/**
	 * @ORM\Column(type="boolean")
	 */
	private $gps = false;
	
	/**
	 * @ORM\Column(type="boolean", name="air_conditioner")
	 */
	private $airConditioner = false;
	
	/**
	 * @ORM\Column(type="boolean", name="sun_roof")
	 */
	private $sunRoof = false;
	
	/**
	 * @ORM\Column(type="boolean", name="non_smokers")
	 */
	private $nonSmokers = false;
	
	/**
	 * @ORM\Column(type="boolean", name="first_aid_kit")
	 */
	private $firstAidKit = false;
		
	/**
	 * @ORM\Column(type="string", name="cool_drinks", length=255)
	 */
	private $coolDrinks;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $snacks;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $dvd;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $gadgets;
	
	/**
	 * @ORM\Column(type="string", name="tools_for_disabled", length=255)
	 */
	private $toolsForDisabled;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $disease;
	
	/**
	 * @ORM\OneToOne(targetEntity="PassengerRequest")
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
     * Set wifi
     *
     * @param boolean $wifi
     * @return VehicleServices
     */
    public function setWifi($wifi)
    {
        $this->wifi = $wifi;

        return $this;
    }

    /**
     * Get wifi
     *
     * @return boolean 
     */
    public function getWifi()
    {
        return $this->wifi;
    }

    /**
     * Set gps
     *
     * @param boolean $gps
     * @return VehicleServices
     */
    public function setGps($gps)
    {
        $this->gps = $gps;

        return $this;
    }

    /**
     * Get gps
     *
     * @return boolean 
     */
    public function getGps()
    {
        return $this->gps;
    }

    /**
     * Set airConditioner
     *
     * @param boolean $airConditioner
     * @return VehicleServices
     */
    public function setAirConditioner($airConditioner)
    {
        $this->airConditioner = $airConditioner;

        return $this;
    }

    /**
     * Get airConditioner
     *
     * @return boolean 
     */
    public function getAirConditioner()
    {
        return $this->airConditioner;
    }

    /**
     * Set sunRoof
     *
     * @param boolean $sunRoof
     * @return VehicleServices
     */
    public function setSunRoof($sunRoof)
    {
        $this->sunRoof = $sunRoof;

        return $this;
    }

    /**
     * Get sunRoof
     *
     * @return boolean 
     */
    public function getSunRoof()
    {
        return $this->sunRoof;
    }

    /**
     * Set nonSmokers
     *
     * @param boolean $nonSmokers
     * @return VehicleServices
     */
    public function setNonSmokers($nonSmokers)
    {
        $this->nonSmokers = $nonSmokers;

        return $this;
    }

    /**
     * Get nonSmokers
     *
     * @return boolean 
     */
    public function getNonSmokers()
    {
        return $this->nonSmokers;
    }

    /**
     * Set firstAidKit
     *
     * @param boolean $firstAidKit
     * @return VehicleServices
     */
    public function setFirstAidKit($firstAidKit)
    {
        $this->firstAidKit = $firstAidKit;

        return $this;
    }

    /**
     * Get firstAidKit
     *
     * @return boolean 
     */
    public function getFirstAidKit()
    {
        return $this->firstAidKit;
    }

    /**
     * Set coolDrinks
     *
     * @param string $coolDrinks
     * @return VehicleServices
     */
    public function setCoolDrinks($coolDrinks)
    {
        $this->coolDrinks = $coolDrinks;

        return $this;
    }

    /**
     * Get coolDrinks
     *
     * @return string 
     */
    public function getCoolDrinks()
    {
        return $this->coolDrinks;
    }

    /**
     * Set snacks
     *
     * @param string $snacks
     * @return VehicleServices
     */
    public function setSnacks($snacks)
    {
        $this->snacks = $snacks;

        return $this;
    }

    /**
     * Get snacks
     *
     * @return string 
     */
    public function getSnacks()
    {
        return $this->snacks;
    }

    /**
     * Set dvd
     *
     * @param string $dvd
     * @return VehicleServices
     */
    public function setDvd($dvd)
    {
        $this->dvd = $dvd;

        return $this;
    }

    /**
     * Get dvd
     *
     * @return string 
     */
    public function getDvd()
    {
        return $this->dvd;
    }

    /**
     * Set gadgets
     *
     * @param string $gadgets
     * @return VehicleServices
     */
    public function setGadgets($gadgets)
    {
        $this->gadgets = $gadgets;

        return $this;
    }

    /**
     * Get gadgets
     *
     * @return string 
     */
    public function getGadgets()
    {
        return $this->gadgets;
    }

    /**
     * Set toolsForDisabled
     *
     * @param string $toolsForDisabled
     * @return VehicleServices
     */
    public function setToolsForDisabled($toolsForDisabled)
    {
        $this->toolsForDisabled = $toolsForDisabled;

        return $this;
    }

    /**
     * Get toolsForDisabled
     *
     * @return string 
     */
    public function getToolsForDisabled()
    {
        return $this->toolsForDisabled;
    }

    /**
     * Set disease
     *
     * @param string $disease
     * @return VehicleServices
     */
    public function setDisease($disease)
    {
        $this->disease = $disease;

        return $this;
    }

    /**
     * Get disease
     *
     * @return string 
     */
    public function getDisease()
    {
        return $this->disease;
    }

    /**
     * Set passengerRequest
     *
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
     * @return VehicleServices
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
