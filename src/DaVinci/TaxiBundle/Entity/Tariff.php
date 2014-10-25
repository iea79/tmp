<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="tariff")
 */
class Tariff {
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="float")
	 * @Assert\Range(
     *      min = 0.01,
     *      minMessage = "Price must be more than {{ limit }}"
     * )
	 */
	private $price = 0.00;
	
	/**
	 * @ORM\Column(type="float")
	 */
	private $tips = 0.00;
	
	/**
	 * @ORM\OneToOne(targetEntity="PassengerRequest", inversedBy="tariff")
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
     * Set price
     *
     * @param float $price
     * @return Tariff
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set tips
     *
     * @param float $tips
     * @return Tariff
     */
    public function setTips($tips)
    {
        $this->tips = $tips;

        return $this;
    }

    /**
     * Get tips
     *
     * @return float 
     */
    public function getTips()
    {
        return $this->tips;
    }

    /**
     * Set passengerRequest
     *
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
     * @return Tariff
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
