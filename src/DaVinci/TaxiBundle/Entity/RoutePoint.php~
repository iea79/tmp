<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="route_point")
 */
class RoutePoint {
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="float", nullable=true)
	 */
	private $latitude = 0.00;
	
	/**
	 * @ORM\Column(type="float", nullable=true)
	 */
	private $longitude = 0.00;
	
	
	/**
	 * @ORM\Column(type="integer", name="post_code", nullable=true)
	 */
	private $postCode;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $place;
	
	/**
	 * @ORM\Column(type="integer", name="sort_value", nullable=true)
	 */
	private $sort;
	
	/**
	 * @ORM\ManyToOne(targetEntity="PassengerRequest", inversedBy="routePoints")
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
     * Set latitude
     *
     * @param float $latitude
     * @return RoutePoint
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return RoutePoint
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set postCode
     *
     * @param integer $postCode
     * @return RoutePoint
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return integer 
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return RoutePoint
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set sort
     *
     * @param integer $sort
     * @return RoutePoint
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return integer 
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set passengerRequest
     *
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
     * @return RoutePoint
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
    
    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
    	if ($this->getPlace() && !trim($this->getPlace())) {
    		$context->buildViolation('This field must be filled!')
    			->atPath('place')
    			->addViolation();
    	}
    }
}
