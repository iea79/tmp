<?php
namespace DaVinci\TaxiBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
  
    protected $termsAccepted;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $skype;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $last_name;


    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="user")
     */
    private $address;
    
    /**
     * @ORM\OneToMany(targetEntity="UserLanguage", mappedBy="user")
     */
    private $userLanguage;

    /**
     * @ORM\OneToMany(targetEntity="TaxiCompany", mappedBy="user")
     */
    private $taxiCompany;

    /**
     * @ORM\OneToMany(targetEntity="TaxiManager", mappedBy="user")
     */
    private $taxiManager;

    /**
     * @ORM\OneToMany(targetEntity="Driver", mappedBy="user")
     */
    private $driver;

    /**
     * @ORM\OneToMany(targetEntity="IndependentDriver", mappedBy="user")
     */
    private $independentDriver;

    /**
     * @ORM\ManyToOne(targetEntity="Currency", inversedBy="user")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     */
    private $currency;
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->userLanguage = new \Doctrine\Common\Collections\ArrayCollection();
        $this->taxiCompany = new \Doctrine\Common\Collections\ArrayCollection();
        $this->taxiManager = new \Doctrine\Common\Collections\ArrayCollection();
        $this->driver = new \Doctrine\Common\Collections\ArrayCollection();
        $this->independentDriver = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = (Boolean) $termsAccepted;
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
     * Set skype
     *
     * @param string $skype
     * @return User
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
     * Set photo
     *
     * @param string $photo
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Add userLanguage
     *
     * @param \DaVinci\TaxiBundle\Entity\UserLanguage $userLanguage
     * @return User
     */
    public function addUserLanguage(\DaVinci\TaxiBundle\Entity\UserLanguage $userLanguage)
    {
        $this->userLanguage[] = $userLanguage;

        return $this;
    }

    /**
     * Remove userLanguage
     *
     * @param \DaVinci\TaxiBundle\Entity\UserLanguage $userLanguage
     */
    public function removeUserLanguage(\DaVinci\TaxiBundle\Entity\UserLanguage $userLanguage)
    {
        $this->userLanguage->removeElement($userLanguage);
    }

    /**
     * Get userLanguage
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserLanguage()
    {
        return $this->userLanguage;
    }

    /**
     * Add taxiCompany
     *
     * @param \DaVinci\TaxiBundle\Entity\TaxiCompany $taxiCompany
     * @return User
     */
    public function addTaxiCompany(\DaVinci\TaxiBundle\Entity\TaxiCompany $taxiCompany)
    {
        $this->taxiCompany[] = $taxiCompany;

        return $this;
    }

    /**
     * Remove taxiCompany
     *
     * @param \DaVinci\TaxiBundle\Entity\TaxiCompany $taxiCompany
     */
    public function removeTaxiCompany(\DaVinci\TaxiBundle\Entity\TaxiCompany $taxiCompany)
    {
        $this->taxiCompany->removeElement($taxiCompany);
    }

    /**
     * Get taxiCompany
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTaxiCompany()
    {
        return $this->taxiCompany;
    }

    /**
     * Add taxiManager
     *
     * @param \DaVinci\TaxiBundle\Entity\TaxiManager $taxiManager
     * @return User
     */
    public function addTaxiManager(\DaVinci\TaxiBundle\Entity\TaxiManager $taxiManager)
    {
        $this->taxiManager[] = $taxiManager;

        return $this;
    }

    /**
     * Remove taxiManager
     *
     * @param \DaVinci\TaxiBundle\Entity\TaxiManager $taxiManager
     */
    public function removeTaxiManager(\DaVinci\TaxiBundle\Entity\TaxiManager $taxiManager)
    {
        $this->taxiManager->removeElement($taxiManager);
    }

    /**
     * Get taxiManager
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTaxiManager()
    {
        return $this->taxiManager;
    }

    /**
     * Add driver
     *
     * @param \DaVinci\TaxiBundle\Entity\Driver $driver
     * @return User
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
     * Add independentDriver
     *
     * @param \DaVinci\TaxiBundle\Entity\IndependentDriver $independentDriver
     * @return User
     */
    public function addIndependentDriver(\DaVinci\TaxiBundle\Entity\IndependentDriver $independentDriver)
    {
        $this->independentDriver[] = $independentDriver;

        return $this;
    }

    /**
     * Remove independentDriver
     *
     * @param \DaVinci\TaxiBundle\Entity\IndependentDriver $independentDriver
     */
    public function removeIndependentDriver(\DaVinci\TaxiBundle\Entity\IndependentDriver $independentDriver)
    {
        $this->independentDriver->removeElement($independentDriver);
    }

    /**
     * Get independentDriver
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIndependentDriver()
    {
        return $this->independentDriver;
    }

    /**
     * Set currency
     *
     * @param \DaVinci\TaxiBundle\Entity\Currency $currency
     * @return User
     */
    public function setCurrency(\DaVinci\TaxiBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \DaVinci\TaxiBundle\Entity\Currency 
     */
    public function getCurrency()
    {
        return $this->currency;
    }
    
    /**
     * Sets the email.
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);
    }

    /**
     * Set the canonical email.
     *
     * @param string $emailCanonical
     * @return User
     */
    public function setEmailCanonical($emailCanonical)
    {
        $this->setUsernameCanonical($emailCanonical);

        return parent::setEmailCanonical($emailCanonical);
    }

    /**
     * Add address
     *
     * @param \DaVinci\TaxiBundle\Entity\Address $address
     * @return User
     */
    public function addAddress(\DaVinci\TaxiBundle\Entity\Address $address)
    {
        $this->address[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \DaVinci\TaxiBundle\Entity\Address $address
     */
    public function removeAddress(\DaVinci\TaxiBundle\Entity\Address $address)
    {
        $this->address->removeElement($address);
    }

    /**
     * Get address
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddress()
    {
        return $this->address;
    }
}
