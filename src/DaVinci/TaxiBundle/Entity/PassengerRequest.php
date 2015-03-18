<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use DaVinci\TaxiBundle\Validator\Constraints as DaVinciAssert;

/**
 * @ORM\Entity(repositoryClass="PassengerRequestRepository")
 * @ORM\Table(name="passenger_request")
 * @DaVinciAssert\RouteInfo(groups={"flow_createPassengerRequest_step1"})
 */
class PassengerRequest {
	
	const STATE_BEFORE_OPEN = 'before-open'; 
	const STATE_OPEN = 'open';
	const STATE_PENDING = 'pending'; 
	const STATE_SOLD = 'sold';
	const STATE_RESCUE = 'rescue'; 
	const STATE_RESCUE_PENDING = 'rescue-pending'; 
	const STATE_RESCUE_CLOSED = 'rescue-closed';
	const STATE_COMPLETED = 'completed';
	const STATE_CANCELED = 'canceled';
	
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
	 * @Assert\NotBlank(groups={"flow_createPassengerRequest_step1"}, message="passengerRequest.pickUpTime.blank")
	 * @Assert\Time(groups={"flow_createPassengerRequest_step1"}, message="passengerRequest.pickUpTime.wrongFormat")
	 */
	private $pickUpTime;
	
	/**
	 * @var \DateTime
	 * @Assert\NotBlank(groups={"flow_createPassengerRequest_step1"}, message="passengerRequest.pickUpDate.blank")
	 * @Assert\Date(groups={"flow_createPassengerRequest_step1"}, message="passengerRequest.pickUpDate.wrongFormat")
	 */
	private $pickUpDate;
	
	/**
	 * @ORM\Column(type="datetimetz", name="return_value", nullable=true)
	 */
	private $return;
	
	/**
	 * @var \DateTime
	 * @Assert\Time(groups={"flow_createPassengerRequest_step1"}, message="passengerRequest.returnTime.wrongFormat")
	 */
	private $returnTime;
	
	/**
	 * @var \DateTime
	 * @Assert\Date(groups={"flow_createPassengerRequest_step1"}, message="passengerRequest.returnDate.wrongFormat")
	 */
	private $returnDate;
	
	/**
	 * @ORM\Column(type="boolean", name="round_trip")
	 */
	private $roundTrip = false;
	
	/**
	 * @ORM\Column(type="float")
	 */
	private $distance = 0.0;
		
	/**
	 * @ORM\Column(type="integer")
	 */
	private $duration = 0;
		
	/**
	 * @ORM\OneToMany(targetEntity="RoutePoint", mappedBy="passengerRequest")
	 * @Assert\Valid() 
	 * @Assert\All({
	 * 		@Assert\NotBlank()
     * })
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
	 * @ORM\Column(type="string", columnDefinition="ENUM('before-open', 'open', 'pending', 'sold', 'rescue', 'rescue-pending', 'rescue-closed', 'completed', 'canceled')", name="state_value", length=20)
	 */
	private $stateValue;
	
	/**
	 * @var \DaVinci\TaxiBundle\Services\PassengerRequestState
	 */
	private $state;
	
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
	 * @Assert\Valid()
	 */
	private $passengerDetail;
	
	/**
	 * @ORM\OneToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	private $user;
		
	/**
	 * @ORM\OneToOne(targetEntity="GeneralDriver")
	 * @ORM\JoinColumn(name="driver_id", referencedColumnName="id")
	 */
	private $driver;
	
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
     * Set distance
     *
     * @param float $distance
     * @return float
     */
    public function setDistance($distance)
    {
    	$this->distance = $distance;
    }
    
    /**
     * Get distance
     *
     * @return float
     */
    public function getDistance()
    {
    	return $this->distance;
    }
        
    /**
     * Set duration
     *
     * @param float $duration
     * @return float
     */
    public function setDuration($duration)
    {
    	$this->duration = $duration;
    }
    
    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration()
    {
    	return $this->duration;
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
     * Set state
     *
     * @param string $stateValue
     * @return PassengerRequest
     */
    public function setStateValue($stateValue)
    {
    	if (!in_array($stateValue, self::getStateList())) {
    		throw new \InvalidArgumentException("Undefined passenger request state :: {$stateValue}");
    	}
    	
    	$this->stateValue = $stateValue;
    	$this->setState($stateValue);
    
    	return $this;
    }
        
    /**
     * Get state
     *
     * @return string
     */
    public function getStateValue()
    {
    	return $this->stateValue;
    }
    
    /**
     * @param string $state
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
     */
    public function setState($state) 
    {
    	$this->state = $this->spawnState($state);
    	
    	return $this;
    }
    
    /**
     * @return \DaVinci\TaxiBundle\Services\State
     */
    public function getState() 
    {
    	if (is_null($this->state)) {
    		$this->state = $this->spawnState($this->stateValue);
    	}
    	
    	return $this->state;
    }
    
    /**
     * @return void
     */
    public function changeState()
    {
    	$this->state->handle();
    	$this->setStateValue($this->state->getName()); 
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
    
    /**
     * Set user
     *
     * @param \DaVinci\TaxiBundle\Entity\User $user
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
     */
    public function setUser(\DaVinci\TaxiBundle\Entity\User $user)
    {
    	$this->user = $user;
    
    	return $this;
    }
    
    /**
     * Get user
     *
     * @return \DaVinci\TaxiBundle\Entity\User
     */
    public function getUser()
    {
    	return $this->user;
    }
    
    /**
     * Set driver
     *
     * @param \DaVinci\TaxiBundle\Entity\GeneralDriver $driver
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
     */
    public function setDriver(\DaVinci\TaxiBundle\Entity\GeneralDriver $driver)
    {
    	$this->driver = $driver;
    
    	return $this;
    }
    
    /**
     * Get driver
     *
     * @return \DaVinci\TaxiBundle\Entity\GeneralDriver
     */
    public function getDriver()
    {
    	return $this->driver;
    }
    
    public static function getStateList() 
    {    	
    	return array(
    		self::STATE_BEFORE_OPEN,
    		self::STATE_OPEN,
    		self::STATE_PENDING,
    		self::STATE_SOLD,
    		self::STATE_RESCUE,
    		self::STATE_RESCUE_PENDING,
    		self::STATE_RESCUE_CLOSED,
    		self::STATE_COMPLETED,
    		self::STATE_CANCELED								
    	);
    }
    
    /**
     * @param string $stateValue
     * @return \DaVinci\TaxiBundle\Entity\State
     */
    private function spawnState($stateValue)
    {
    	switch ($stateValue) {
    		case self::STATE_BEFORE_OPEN: {
    			$state = new \DaVinci\TaxiBundle\Services\PassengerRequest\BeforeOpenState($this);
    			break;
    		}
    		
    		case self::STATE_OPEN: {
    			$state = new \DaVinci\TaxiBundle\Services\PassengerRequest\OpenState($this);
    			break;
    		}
    		
    		case self::STATE_PENDING: {
    			$state = new \DaVinci\TaxiBundle\Services\PassengerRequest\PendingState($this);
    			break;
    		}
    		
    		case self::STATE_SOLD: {
    			$state = new \DaVinci\TaxiBundle\Services\PassengerRequest\SoldState($this);
    			break;
    		}
    		
    		case self::STATE_RESCUE: {
    			$state = new \DaVinci\TaxiBundle\Services\PassengerRequest\RescueState($this);
    			break;
    		}
    		
    		case self::STATE_RESCUE_PENDING: {
    			$state = new \DaVinci\TaxiBundle\Services\PassengerRequest\RescuePendingState($this);
    			break;
    		}
    		
    		case self::STATE_RESCUE_CLOSED: {
    			$state = new \DaVinci\TaxiBundle\Services\PassengerRequest\RescueClosedState($this);
    			break;
    		}
    		
    		case self::STATE_COMPLETED: {
    			$state = new \DaVinci\TaxiBundle\Services\PassengerRequest\CompletedState($this);
    			break;
    		}
    		
    		case self::STATE_CANCELED: {
    			$state = new \DaVinci\TaxiBundle\Services\PassengerRequest\CanceledState($this);
    			break;
    		}
    		
    		default:
    			throw new \InvalidArgumentException("Undefined passenger request state :: {$stateValue}");
    	}
    	
    	$state->setName($stateValue);
    	
    	return $state;
    }
}
