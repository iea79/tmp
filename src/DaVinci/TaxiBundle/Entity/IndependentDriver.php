<?php
namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Mykola Sedletskyi <icevita@gmail.com>
 */

/**
 * @ORM\Entity(repositoryClass="IndependentDriverRepository")
 * @ORM\Table(name="independent_driver")
 */
class IndependentDriver extends GeneralDriver
{
	
    const LESS_THAN_4  = 0;
    const MORE_THAN_4 = 1;
    
    /**
     * @Assert\Valid()
     * @ORM\OneToOne(targetEntity="\DaVinci\TaxiBundle\Entity\Address", cascade={"persist", "remove"})
     */
    private $address;
    
    /**
     * @Assert\Valid()
     * @ORM\OneToOne(targetEntity="User", inversedBy="independentDriver")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
	/**
	 * @Assert\Valid()
	 * @Assert\All({
	 * 		@Assert\NotBlank()
     * })
	 * @ORM\ManyToMany(targetEntity="Phone", cascade={"persist", "remove"})
	 * @ORM\JoinTable(name="DriverPhone",
	 *      joinColumns={@ORM\JoinColumn(name="company_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="phone_id", referencedColumnName="id", unique=true)}
	 * )
	 */
    private $phones;
        
    /**
     * @Assert\Valid()
     * @ORM\OneToOne(targetEntity="DriverVehicle", mappedBy="driver", cascade={"persist", "remove"})
     */
    private $vehicle;
    
    /**
     * Constructor
     */
    public function __construct()
    {
    	$this->phones = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get vehicle
     *
     * @return DriverVehicle 
     */
    function getVehicle() {
        return $this->vehicle;
    }

    /**
     * Set vehicle
     *
     * @param DriverVehicle $vehicle
     * @return Driver
     */
    public function setVehicle($vehicle) {
        $this->vehicle = $vehicle;
        $this->vehicle->setDriver($this);
        
        return $this;
    }
    
    /**
     * Get id
     *
     * @return \DaVinci\TaxiBundle\Entity\Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set name
     *
     * @param \DaVinci\TaxiBundle\Entity\Address $name
     * @return IndependentDriver
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }
    
    /**
     * Get experience name
     *
     * @return integer 
     */
    public function getExperienceNamed()
    {
        return self::getDriverExperienceOptions()[$this->experience];
    }
    
    /**
     * Set user
     *
     * @param \DaVinci\TaxiBundle\Entity\User $user
     * @return IndependentDriver
     */
    public function setUser(\DaVinci\TaxiBundle\Entity\User $user = null)
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
     * Add phones
     *
     * @param \DaVinci\TaxiBundle\Entity\Phone $phones
     * @return IndependentDriver
     */
    public function addPhone(\DaVinci\TaxiBundle\Entity\Phone $phones)
    {
        $this->phones[] = $phones;

        return $this;
    }

    /**
     * Remove phones
     *
     * @param \DaVinci\TaxiBundle\Entity\Phone $phones
     */
    public function removePhone(\DaVinci\TaxiBundle\Entity\Phone $phones)
    {
        $this->phones->removeElement($phones);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhones()
    {
        return $this->phones;
    }
    
    static public function getDriverExperienceOptions()
    {
    	return array(
    			self::LESS_THAN_4 => 'less than 4 years',
    			self::MORE_THAN_4 => 'more than 4 years'
    	);
    }
        
}
