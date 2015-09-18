<?php

namespace DaVinci\TaxiBundle\Entity\FakeRequest;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="CategoryRepository")
 * @ORM\Table(name="fake_category")
 */
class Category 
{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", length=5)
	 */
	private $code;
	
	/**
	 * @ORM\Column(type="integer", name="showing_time")
	 */ 
	private $showingTime = 0;
	
	/**
	 * @ORM\Column(type="integer", name="appearance_percent")
	 */
	private $appearancePercent = 0;
	
	/**
	 * @ORM\Column(type="integer", name="canceled_percent")
	 */
	private $canceledPercent = 0;
	
	/**
	 * @ORM\Column(type="integer", name="total_canceled_percent")
	 */
	private $totalCanceledPercent = 0;
	
	/**
	 * @ORM\Column(type="integer", name="cancelation_interval")
	 */
	private $cancelationInterval = 0;
	
	/**
	 * @ORM\OneToMany(targetEntity="Deal", mappedBy="category")
	 */
	private $deals;
	
	public function __construct()
	{
		$this->deals = new ArrayCollection();
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
     * Set code
     *
     * @param string $code
     *
     * @return Category
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set showingTime
     *
     * @param integer $showingTime
     *
     * @return Category
     */
    public function setShowingTime($showingTime)
    {
        $this->showingTime = $showingTime;

        return $this;
    }

    /**
     * Get showingTime
     *
     * @return integer
     */
    public function getShowingTime()
    {
        return $this->showingTime;
    }

    /**
     * Set appearancePercent
     *
     * @param integer $appearancePercent
     *
     * @return Category
     */
    public function setAppearancePercent($appearancePercent)
    {
        $this->appearancePercent = $appearancePercent;

        return $this;
    }

    /**
     * Get appearancePercent
     *
     * @return integer
     */
    public function getAppearancePercent()
    {
        return $this->appearancePercent;
    }

    /**
     * Set canceledPercent
     *
     * @param integer $canceledPercent
     *
     * @return Category
     */
    public function setCanceledPercent($canceledPercent)
    {
        $this->canceledPercent = $canceledPercent;

        return $this;
    }

    /**
     * Get canceledPercent
     *
     * @return integer
     */
    public function getCanceledPercent()
    {
        return $this->canceledPercent;
    }

    /**
     * Set totalCanceledPercent
     *
     * @param integer $totalCanceledPercent
     *
     * @return Category
     */
    public function setTotalCanceledPercent($totalCanceledPercent)
    {
        $this->totalCanceledPercent = $totalCanceledPercent;

        return $this;
    }

    /**
     * Get totalCanceledPercent
     *
     * @return integer
     */
    public function getTotalCanceledPercent()
    {
        return $this->totalCanceledPercent;
    }

    /**
     * Set cancelationInterval
     *
     * @param integer $cancelationInterval
     *
     * @return Category
     */
    public function setCancelationInterval($cancelationInterval)
    {
        $this->cancelationInterval = $cancelationInterval;

        return $this;
    }

    /**
     * Get cancelationInterval
     *
     * @return integer
     */
    public function getCancelationInterval()
    {
        return $this->cancelationInterval;
    }

    /**
     * Add deal
     *
     * @param \DaVinci\TaxiBundle\Entity\FakeRequest\Deal $deal
     *
     * @return Category
     */
    public function addDeal(\DaVinci\TaxiBundle\Entity\FakeRequest\Deal $deal)
    {
        $this->deals[] = $deal;

        return $this;
    }

    /**
     * Remove deal
     *
     * @param \DaVinci\TaxiBundle\Entity\FakeRequest\Deal $deal
     */
    public function removeDeal(\DaVinci\TaxiBundle\Entity\FakeRequest\Deal $deal)
    {
        $this->deals->removeElement($deal);
    }

    /**
     * Get deals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeals()
    {
        return $this->deals;
    }
}
