<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use DaVinci\TaxiBundle\Validator\Constraints as DaVinciAssert;

/**
 * @ORM\Entity(repositoryClass="PassengerRequestRepository")
 * @ORM\Table(name="passenger_request")
 * @DaVinciAssert\RouteInfo(groups={"flow_createPassengerRequest_step1", "edit_passenger_request"})
 * @DaVinciAssert\Tariff(groups={"flow_createPassengerRequest_step3", "edit_passenger_request"})
 */
class PassengerRequest 
{
    
    const REQUEST_TIMEZONE = 'Europe/Moscow';
	
	const STATE_BEFORE_OPEN = 'before-open'; 
	const STATE_OPEN = 'open';
	const STATE_PENDING = 'pending'; 
	const STATE_SOLD = 'sold';
	const STATE_APPROVED_SOLD = 'approved-sold';
	const STATE_FINALLY_APPROVED = 'finally-approved';
	const STATE_RESCUE = 'rescue'; 
	const STATE_RESCUE_PENDING = 'rescue-pending'; 
	const STATE_RESCUE_CLOSED = 'rescue-closed';
	const STATE_COMPLETED = 'completed';
	const STATE_CANCELED = 'canceled';
	
	const AVAILABLE_PICKUP_PERIOD = 12;
	const POSSIBLE_DRIVERS_PER_REQUEST = 5;
	const CANCELATION_PERIOD = 2;
    
    const NOT_LEFT_TIME = '00:00:00';
	
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
	 * @Assert\NotBlank(groups={"flow_createPassengerRequest_step1", "edit_passenger_request"}, message="passengerRequest.pickUpTime.blank")
	 * @Assert\Time(groups={"flow_createPassengerRequest_step1", "edit_passenger_request"}, message="passengerRequest.pickUpTime.wrongFormat")
	 */
	private $pickUpTime;
	
	/**
	 * @var \DateTime
	 * @Assert\NotBlank(groups={"flow_createPassengerRequest_step1", "edit_passenger_request"}, message="passengerRequest.pickUpDate.blank")
	 * @Assert\Date(groups={"flow_createPassengerRequest_step1", "edit_passenger_request"}, message="passengerRequest.pickUpDate.wrongFormat")
	 */
	private $pickUpDate;
	
	/**
	 * @ORM\Column(type="datetimetz", name="return_value", nullable=true)
	 */
	private $return;
	
	/**
	 * @var \DateTime
	 * @Assert\Time(groups={"flow_createPassengerRequest_step1", "edit_passenger_request"}, message="passengerRequest.returnTime.wrongFormat")
	 */
	private $returnTime;
	
	/**
	 * @var \DateTime
	 * @Assert\Date(groups={"flow_createPassengerRequest_step1", "edit_passenger_request"}, message="passengerRequest.returnDate.wrongFormat")
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
	 * 		@Assert\NotBlank(),
	 * 		@Assert\Length(min=2, max=100)
     * })
	 */
	private $routePoints;
	
	/**
	 * @ORM\OneToOne(targetEntity="Tariff", mappedBy="passengerRequest")
	 * @Assert\Valid()
	 */
	private $tariff;
	
	/**
	 * @ORM\OneToOne(targetEntity="Vehicle", mappedBy="passengerRequest")
	 * @Assert\Valid()
	 */
	private $vehicle;
	
	/**
	 * @ORM\Column(type="string", columnDefinition="ENUM('before-open', 'open', 'pending', 'sold', 'approved-sold', 'rescue', 'rescue-pending', 'rescue-closed', 'completed', 'canceled')", name="state_value", length=20)
	 */
	private $stateValue;
	
	/**
	 * @var \DaVinci\TaxiBundle\Services\State
	 */
	private $state;
	
	/**
	 * @ORM\OneToOne(targetEntity="VehicleOptions", mappedBy="passengerRequest")
	 */
	private $vehicleOptions;
	
	/**
	 * @ORM\OneToOne(targetEntity="VehicleServices", mappedBy="passengerRequest")
     */
	private $vehicleServices;

	/**
	 * @ORM\OneToOne(targetEntity="VehicleDriverConditions", mappedBy="passengerRequest")
     * @Assert\Valid()
	 */
	private $vehicleDriverConditions;
	
	/**
	 * @ORM\OneToOne(targetEntity="PassengerDetail", mappedBy="passengerRequest")
	 * @Assert\Valid()
	 */
	private $passengerDetail;
	
	/**
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	private $user;
		
	/**
	 * @ORM\ManyToOne(targetEntity="GeneralDriver")
	 * @ORM\JoinColumn(name="driver_id", referencedColumnName="id")
	 */
	private $driver;
	
	/**
	 * @ORM\ManyToMany(targetEntity="GeneralDriver", inversedBy="possibleRequests")
	 * @ORM\JoinTable(name="requests_drivers",
	 * 		joinColumns={@ORM\JoinColumn(name="passenger_request_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="driver_id", referencedColumnName="id")}
     * )
	 */
	private $possibleDrivers;
	
	/**
	 * @ORM\ManyToMany(targetEntity="GeneralDriver", inversedBy="canceledRequests")
	 * @ORM\JoinTable(name="requests_drivers_canceled",
	 * 		joinColumns={@ORM\JoinColumn(name="passenger_request_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="driver_id", referencedColumnName="id")}
	 * )
	 */
	private $canceledDrivers;
	
	/**
	 * @ORM\Column(type="boolean", name="is_real")
	 */
	private $isReal = true;
	
	/**
	 * @ORM\ManyToOne(targetEntity="\DaVinci\TaxiBundle\Entity\FakeRequest\Category")
	 * @ORM\JoinColumn(name="fake_category_id", referencedColumnName="id")
	 */
	private $fakeCategory;
	
	public function __construct() {
		$this->routePoints = new ArrayCollection();
		$this->possibleDrivers = new ArrayCollection();
		$this->canceledDrivers = new ArrayCollection();
	}

    /**
     * Get id
     *
     * @param integer $id
     * @return PassengerRequest
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
        
        $this->setPickUpTime($pickUp);
        $this->setPickUpDate($pickUp);

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
    
    public function getPickUpLeft()
    {
    	$now = new \DateTime('now');
        $now->setTimezone(new \DateTimeZone(self::REQUEST_TIMEZONE));
        
        $difference = $now->diff($this->pickUp);
        if (0 == $difference->format('%d')) {
            return $difference->format('%H:%I:%S');
        }
        
        if (1 == $difference->invert) {
            return self::NOT_LEFT_TIME;
        }
        
    	return $difference->format('%a (days)');
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

        $this->setReturnTime($return);
        $this->setReturnDate($return);
        
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
     * @return string
     */
    public function getFormattedDistance()
    {
    	return number_format($this->distance / 1000, 1);
    }
    
    public function getDistanceInMiles()
    {
    	return number_format($this->distance / 1000 * 0.621, 1);
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
     * @return string
     */
    public function getFormattedDuration()
    {
    	return number_format($this->duration / 60, 1);
    }
    
    /**
     * Add routePoints
     *
     * @param \DaVinci\TaxiBundle\Entity\RoutePoint $routePoints
     * @return PassengerRequest
     */
    public function addRoutePoint(\DaVinci\TaxiBundle\Entity\RoutePoint $routePoint)
    {
        $this->routePoints[] = $routePoint;

        return $this;
    }

    /**
     * Remove routePoints
     *
     * @param \DaVinci\TaxiBundle\Entity\RoutePoint $routePoints
     */
    public function removeRoutePoint(\DaVinci\TaxiBundle\Entity\RoutePoint $routePoint)
    {
        $this->routePoints->removeElement($routePoint);
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
    	if (is_null($this->state)) {
    		$this->state = $this->spawnState($this->stateValue);
    	}
    	
    	$this->state->handle();
    	$this->setStateValue($this->state->getName()); 
    }
    
    /**
     * @return void
     */
    public function cancelState()
    {
    	if (is_null($this->state)) {
    		$this->state = $this->spawnState($this->stateValue);
    	}
    	 
    	$this->state->cancel();
    	$this->setStateValue($this->state->getName());
    }
    
    /**
     * @return void
     */
    public function resetToPendingState()
    {
    	if (is_null($this->state)) {
    		$this->state = $this->spawnState($this->stateValue);
    	}
    
    	$this->state->resetToPending();
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
    public function setDriver(\DaVinci\TaxiBundle\Entity\GeneralDriver $driver = null)
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
    
    /**
     * Add possibleDrivers
     *
     * @param \DaVinci\TaxiBundle\Entity\GeneralDriver $possibleDriver
     * @return PassengerRequest
     */
    public function addPossibleDriver(\DaVinci\TaxiBundle\Entity\GeneralDriver $possibleDriver)
    {
    	$this->possibleDrivers[] = $possibleDriver;
    
    	return $this;
    }
    
    /**
     * Remove possibleDrivers
     *
     * @param \DaVinci\TaxiBundle\Entity\GeneralDriver $possibleDriver
     */
    public function removePossibleDriver(\DaVinci\TaxiBundle\Entity\GeneralDriver $possibleDriver)
    {
    	$this->possibleDrivers->removeElement($possibleDriver);
    }
    
    /**
     * Get possibleDrivers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPossibleDrivers()
    {
    	return $this->possibleDrivers;
    }
    
    /**
     * Add canceledDrivers
     *
     * @param \DaVinci\TaxiBundle\Entity\GeneralDriver $possibleDriver
     * @return PassengerRequest
     */
    public function addCanceledDrivers(\DaVinci\TaxiBundle\Entity\GeneralDriver $canceledDriver)
    {
    	$this->canceledDrivers[] = $canceledDriver;
    
    	return $this;
    }
    
    /**
     * Remove canceledDrivers
     *
     * @param \DaVinci\TaxiBundle\Entity\GeneralDriver $possibleDriver
     */
    public function removeCanceledDrivers(\DaVinci\TaxiBundle\Entity\GeneralDriver $canceledDriver)
    {
    	$this->canceledDrivers->removeElement($canceledDriver);
    }
    
    /**
     * Get canceledDrivers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCanceledDrivers()
    {
    	return $this->canceledDrivers;
    }

    /**
     * Set isReal
     *
     * @param boolean $isReal
     *
     * @return PassengerRequest
     */
    public function setIsReal($isReal)
    {
    	$this->isReal = $isReal;
    
    	return $this;
    }
    
    /**
     * Get isReal
     *
     * @return boolean
     */
    public function getIsReal()
    {
    	return $this->isReal;
    }
    
    /**
     * @return array
     */
    public function getPossibleDriversIds()
    {
    	$iterator = $this->possibleDrivers->getIterator();
    	$iterator->rewind();
    	
    	$ids = array();
    	while ($iterator->valid()) {
    		$ids[] = $iterator->current()->getId();
    		$iterator->next();
    	}
    	
    	return $ids;
    }
    
    /**
     * @return number
     */
    public function getPossibleDriversNumber()
    {
    	return $this->possibleDrivers->count();
    }
    
    /**
     * @param integer $driverId
     * @return boolean
     */
    public function isDriverInList($driverId)
    {
    	return in_array($driverId, $this->getPossibleDriversIds());
    }
    
    /**
     * 
     * @return array
     */
    public static function getStateList() 
    {    	
    	return array(
    		self::STATE_BEFORE_OPEN,
    		self::STATE_OPEN,
    		self::STATE_PENDING,
    		self::STATE_SOLD,
    		self::STATE_APPROVED_SOLD,
            self::STATE_FINALLY_APPROVED,
    		self::STATE_RESCUE,
    		self::STATE_RESCUE_PENDING,
    		self::STATE_RESCUE_CLOSED,
    		self::STATE_COMPLETED,
    		self::STATE_CANCELED								
    	);
    }
    
    /**
     * @return \DateTime
     */
    public static function getAvailablePickUp()
    {
    	return new \DateTime('+' . self::AVAILABLE_PICKUP_PERIOD . ' hour');
    }

    /**
     * @return string
     */
    public function getFullRoute()
    {
    	$route = array();
    	
    	$iterator = $this->routePoints->getIterator();
    	$iterator->rewind();
    	while ($iterator->valid()) {
    		$route[] = $iterator->current()->getPlace();
    		
    		$iterator->next();
    	}
    	
    	return implode(';', $route);
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
    		
    		case self::STATE_APPROVED_SOLD: {
    			$state = new \DaVinci\TaxiBundle\Services\PassengerRequest\ApprovedSoldState($this);
    			break;
    		}
    		
    		case self::STATE_FINALLY_APPROVED: {
    			$state = new \DaVinci\TaxiBundle\Services\PassengerRequest\FinallyApprovedState($this);
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

?>