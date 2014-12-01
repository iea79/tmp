<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="passenger_request")
 */
class PassengerRequest {
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="datetimetz", name="create_date")
	 */
	private $createDate;
	
	/**
	 * @ORM\Column(type="datetimetz", name="pick_up")
	 */
	private $pickUp;
	
	/**
	 * @var \DateTime
	 * @Assert\NotBlank()
	 * @Assert\Time()
	 */
	private $pickUpTime;
	
	/**
	 * @var \DateTime
	 * @Assert\NotBlank()
	 * @Assert\Date()
	 */
	private $pickUpDate;
	
	/**
	 * @ORM\Column(type="datetimetz", nullable=true)
	 */
	private $return;
	
	/**
	 * @var \DateTime
	 * @Assert\NotBlank()
	 * @Assert\Time()
	 */
	private $returnTime;
	
	/**
	 * @var \DateTime
	 * @Assert\NotBlank()
	 * @Assert\Date()
	 */
	private $returnDate;
	
	/**
	 * @ORM\Column(type="boolean", name="round_trip")
	 */
	private $roundTrip = false;
	
	/**
	 * @ORM\OneToMany(targetEntity="RoutePoint", mappedBy="passengerRequest")
	 * @Assert\Valid()
	 */
	private $routePoints;
	
	/**
	 * @ORM\OneToOne(targetEntity="Tariff", mappedBy="passengerRequest")
	 */
	private $tariff;
	
	/**
	 * @ORM\OneToOne(targetEntity="Vehicle", mappedBy="passengerRequest")
	 */
	private $vehicle;
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\VehicleOptions
	 */
	private $vehicleOptions;
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\VehicleServices
	 */
	private $vehicleServices;

	/**
	 * @var \DaVinci\TaxiBundle\Entity\VehicleDriverConditions
	 */
	private $vehicleDriverConditions;
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\PassengerDetail
	 */
	private $passengerDetail;
	
	public function __construct() {
		$this->routePoints = new ArrayCollection();
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
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return PassengerRequest
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set pickUp
     *
     * @param \DateTime $pickUp
     * @return PassengerRequest
     */
    public function setPickUp($pickUp)
    {
        $this->pickUp = $pickUp;

        return $this;
    }

    /**
     * Get pickUp
     *
     * @return \DateTime 
     */
    public function getPickUp()
    {
        return $this->pickUp;
    }
    
    /**
     * Set pickUpTime
     *
     * @param \DateTime $pickUpTime
     * @return PassengerRequest
     */
    public function setPickUpTime($pickUpTime)
    {
    	$this->pickUpTime = $pickUpTime;
    
    	return $this;
    }
    
    /**
     * Get pickUpTime
     *
     * @return \DateTime
     */
    public function getPickUpTime()
    {
    	return $this->pickUpTime;
    }
    
    /**
     * Set pickUpDate
     *
     * @param \DateTime $pickUpDate
     * @return PassengerRequest
     */
    public function setPickUpDate($pickUpDate)
    {
    	$this->pickUpDate = $pickUpDate;
    
    	return $this;
    }
    
    /**
     * Get pickUpDate
     *
     * @return \DateTime
     */
    public function getPickUpDate()
    {
    	return $this->pickUpDate;
    }

    /**
     * Set return
     *
     * @param \DateTime $return
     * @return PassengerRequest
     */
    public function setReturn($return)
    {
        $this->return = $return;

        return $this;
    }

    /**
     * Get return
     *
     * @return \DateTime 
     */
    public function getReturn()
    {
        return $this->return;
    }
    
    /**
     * Set returnTime
     *
     * @param \DateTime $returnTime
     * @return PassengerRequest
     */
    public function setReturnTime($returnTime)
    {
    	$this->returnTime = $returnTime;
    
    	return $this;
    }
    
    /**
     * Get returnTime
     *
     * @return \DateTime
     */
    public function getReturnTime()
    {
    	return $this->returnTime;
    }
    
    /**
     * Set returnDate
     *
     * @param \DateTime $returnDate
     * @return PassengerRequest
     */
    public function setReturnDate($returnDate)
    {
    	$this->returnDate = $returnDate;
    
    	return $this;
    }
    
    /**
     * Get returnDate
     *
     * @return \DateTime
     */
    public function getReturnDate()
    {
    	return $this->returnDate;
    }
    
    /**
     * Set roundTrip
     *
     * @param boolean $roundTrip
     * @return PassengerRequest
     */
    public function setRoundTrip($roundTrip)
    {
    	$this->roundTrip = $roundTrip;
    
    	return $this;
    }
    
    /**
     * Get roundTrip
     *
     * @return boolean
     */
    public function getRoundTrip()
    {
    	return $this->roundTrip;
    }

    /**
     * Add routePoints
     *
     * @param \DaVinci\TaxiBundle\Entity\RoutePoint $routePoints
     * @return PassengerRequest
     */
    public function addRoutePoint(\DaVinci\TaxiBundle\Entity\RoutePoint $routePoints)
    {
        $this->routePoints[] = $routePoints;

        return $this;
    }

    /**
     * Remove routePoints
     *
     * @param \DaVinci\TaxiBundle\Entity\RoutePoint $routePoints
     */
    public function removeRoutePoint(\DaVinci\TaxiBundle\Entity\RoutePoint $routePoints)
    {
        $this->routePoints->removeElement($routePoints);
    }

    /**
     * Get routePoints
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoutePoints()
    {
        return $this->routePoints;
    }

    /**
     * Set tariff
     *
     * @param \DaVinci\TaxiBundle\Entity\Tariff $tariff
     * @return PassengerRequest
     */
    public function setTariff(\DaVinci\TaxiBundle\Entity\Tariff $tariff = null)
    {
        $this->tariff = $tariff;

        return $this;
    }

    /**
     * Get tariff
     *
     * @return \DaVinci\TaxiBundle\Entity\Tariff 
     */
    public function getTariff()
    {
        return $this->tariff;
    }

    /**
     * Set vehicle
     *
     * @param \DaVinci\TaxiBundle\Entity\Vehicle $vehicle
     * @return PassengerRequest
     */
    public function setVehicle(\DaVinci\TaxiBundle\Entity\Vehicle $vehicle = null)
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * Get vehicle
     *
     * @return \DaVinci\TaxiBundle\Entity\Vehicle 
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }
    
    /**
     * Set vehicleOptions
     *
     * @param \DaVinci\TaxiBundle\Entity\VehicleOptions $options
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
     */
    public function setVehicleOptions(\DaVinci\TaxiBundle\Entity\VehicleOptions $options)
    {
    	$this->vehicleOptions = $options;
    	
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
     * Set vehicleServices
     *
     * @param \DaVinci\TaxiBundle\Entity\VehicleServices $services
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
     */
    public function setVehicleServices(\DaVinci\TaxiBundle\Entity\VehicleServices $services)
    {
    	$this->vehicleServices = $services;
    	 
    	return $this;
    }
    
    /**
     * Get vehicleServices
     *
     * @return \DaVinci\TaxiBundle\Entity\VehicleServices
     */
    public function getVehicleServices()
    {
    	return $this->vehicleServices;
    }
    
    /**
     * Set vehicleDriverConditions
     *
     * @param \DaVinci\TaxiBundle\Entity\VehicleDriverConditions $driverConditions
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
     */
    public function setVehicleDriverConditions(\DaVinci\TaxiBundle\Entity\VehicleDriverConditions $driverConditions)
    {
    	$this->vehicleDriverConditions = $driverConditions;
    
    	return $this;
    }
    
    /**
     * Get vehicleDriverConditions
     *
     * @return \DaVinci\TaxiBundle\Entity\VehicleDriverConditions
     */
    public function getVehicleDriverConditions()
    {
    	return $this->vehicleDriverConditions;
    }
    
    /**
     * Set passengerDetail
     *
     * @param \DaVinci\TaxiBundle\Entity\PassengerDetail $passengerDetail
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
     */
    public function setPassengerDetail(\DaVinci\TaxiBundle\Entity\PassengerDetail $passengerDetail)
    {
    	$this->passengerDetail = $passengerDetail;
    
    	return $this;
    }
    
    /**
     * Get passengerDetail
     *
     * @return \DaVinci\TaxiBundle\Entity\PassengerDetail
     */
    public function getPassengerDetail()
    {
    	return $this->passengerDetail;
    }
}
