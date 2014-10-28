<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
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
	 * @ORM\Column(type="datetimetz", nullable=true)
	 */
	private $return;
	
	/**
	 * @ORM\OneToMany(targetEntity="RoutePoint", mappedBy="passengerRequest")
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
}
