<?php
namespace DaVinci\TaxiBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Mykola Sedletskyi <icevita@gmail.com>
 */


/**
 * @ORM\Entity
 */
class TaxiCompany
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $registration_date;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $registration_place;

    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $skype;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $registraition_number;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $cars_amount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\OneToMany(targetEntity="TaxiManager", mappedBy="taxiCompany")
     */
    private $manager;

    /**
     * @ORM\OneToMany(targetEntity="Driver", mappedBy="taxiCompany")
     */
    private $driver;

    /**
     * @ORM\OneToOne(targetEntity="\DaVinci\TaxiBundle\Entity\Address", cascade={"persist", "remove"})
     */
    private $address;
    
    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="taxiCompany")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->manager = new \Doctrine\Common\Collections\ArrayCollection();
        $this->driver = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param string $name
     * @return TaxiCompany
     */
    public function setAddress($address)
    {
        $this->address = $address;

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
     * Set name
     *
     * @param string $name
     * @return TaxiCompany
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set registration_date
     *
     * @param \DateTime $registrationDate
     * @return TaxiCompany
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registration_date = $registrationDate;

        return $this;
    }

    /**
     * Get registration_date
     *
     * @return \DateTime 
     */
    public function getRegistrationDate()
    {
        return $this->registration_date;
    }

    /**
     * Set registration_place
     *
     * @param string $registrationPlace
     * @return TaxiCompany
     */
    public function setRegistrationPlace($registrationPlace)
    {
        $this->registration_place = $registrationPlace;

        return $this;
    }

    /**
     * Get registration_place
     *
     * @return string 
     */
    public function getRegistrationPlace()
    {
        return $this->registration_place;
    }

    
    /**
     * Set skype
     *
     * @param string $registrationPlace
     * @return TaxiCompany
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;

        return $this;
    }

    /**
     * Get skype
     *
     * @return string 
     */
    public function getSkype()
    {
        return $this->skype;
    }
    
    /**
     * Set registraition_number
     *
     * @param string $registraitionNumber
     * @return TaxiCompany
     */
    public function setRegistraitionNumber($registraitionNumber)
    {
        $this->registraition_number = $registraitionNumber;

        return $this;
    }

    /**
     * Get registraition_number
     *
     * @return string 
     */
    public function getRegistraitionNumber()
    {
        return $this->registraition_number;
    }

    /**
     * Set cars_amount
     *
     * @param integer $carsAmount
     * @return TaxiCompany
     */
    public function setCarsAmount($carsAmount)
    {
        $this->cars_amount = $carsAmount;

        return $this;
    }

    /**
     * Get cars_amount
     *
     * @return integer 
     */
    public function getCarsAmount()
    {
        return $this->cars_amount;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return TaxiCompany
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Add manager
     *
     * @param \DaVinci\TaxiBundle\Entity\TaxiManager $manager
     * @return TaxiCompany
     */
    public function addManager(\DaVinci\TaxiBundle\Entity\TaxiManager $manager)
    {
        $this->manager[] = $manager;

        return $this;
    }

    /**
     * Remove manager
     *
     * @param \DaVinci\TaxiBundle\Entity\TaxiManager $manager
     */
    public function removeManager(\DaVinci\TaxiBundle\Entity\TaxiManager $manager)
    {
        $this->manager->removeElement($manager);
    }

    /**
     * Get manager
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Add driver
     *
     * @param \DaVinci\TaxiBundle\Entity\Driver $driver
     * @return TaxiCompany
     */
    public function addDriver(\DaVinci\TaxiBundle\Entity\Driver $driver)
    {
        $this->driver[] = $driver;

        return $this;
    }

    /**
     * Remove driver
     *
     * @param \DaVinci\TaxiBundle\Entity\Driver $driver
     */
    public function removeDriver(\DaVinci\TaxiBundle\Entity\Driver $driver)
    {
        $this->driver->removeElement($driver);
    }

    /**
     * Get driver
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDriver()
    {
        return $this->driver;
    }


    /**
     * Set user
     *
     * @param \DaVinci\TaxiBundle\Entity\User $user
     * @return TaxiCompany
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
}
