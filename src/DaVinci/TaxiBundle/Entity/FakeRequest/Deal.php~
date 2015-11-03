<?php

namespace DaVinci\TaxiBundle\Entity\FakeRequest;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="DealRepository")
 * @ORM\Table(name="fake_deal")
 */
class Deal 
{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="integer", name="week_day")
	 */
	private $weekDay;
	
	/**
	 * @ORM\Column(type="time", name="deal_time")
	 */
	private $dealTime;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Category", inversedBy="deals")
	 * @ORM\JoinColumn(name="fake_category_id", referencedColumnName="id")
	 */
	private $category;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	private $number;
	
	/**
	 * @ORM\Column(type="integer", name="responded_number")
	 */
	private $respondedNumber;
	

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
     * Set weekDay
     *
     * @param integer $weekDay
     *
     * @return Deal
     */
    public function setWeekDay($weekDay)
    {
        $this->weekDay = $weekDay;

        return $this;
    }

    /**
     * Get weekDay
     *
     * @return integer
     */
    public function getWeekDay()
    {
        return $this->weekDay;
    }

    /**
     * Set dealTime
     *
     * @param \DateTime $dealTime
     *
     * @return Deal
     */
    public function setDealTime($dealTime)
    {
        $this->dealTime = $dealTime;

        return $this;
    }

    /**
     * Get dealTime
     *
     * @return \DateTime
     */
    public function getDealTime()
    {
        return $this->dealTime;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Deal
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set respondedNumber
     *
     * @param integer $respondedNumber
     *
     * @return Deal
     */
    public function setRespondedNumber($respondedNumber)
    {
        $this->respondedNumber = $respondedNumber;

        return $this;
    }

    /**
     * Get respondedNumber
     *
     * @return integer
     */
    public function getRespondedNumber()
    {
        return $this->respondedNumber;
    }

    /**
     * Set category
     *
     * @param \DaVinci\TaxiBundle\Entity\FakeRequest\Category $category
     *
     * @return Deal
     */
    public function setCategory(\DaVinci\TaxiBundle\Entity\FakeRequest\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \DaVinci\TaxiBundle\Entity\FakeRequest\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
