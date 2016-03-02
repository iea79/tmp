<?php
namespace DaVinci\TaxiBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping AS ORM;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;

/**
 * @ORM\Entity
 * @FileStore\Uploadable
 */

class User extends BaseUser
{

    public $curentMoney = '100000.00';     // Current Money in business - must reales from DB

    private function getBisnesMoney()
    {

    }
    
    private $timeToUpdatePassword = 7889231; //3 months
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToMany(targetEntity="DaVinci\TaxiBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $termsAccepted = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $skype;

    /**
     * @Assert\File( maxSize="20M", groups={"full"})
     * @FileStore\UploadableField(mapping="photo")
     * @ORM\Column(type="array")
     */
    private $photo;

  	/*
     * @ORM\OneToMany(targetEntity="Address", mappedBy="user", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
//  private $addresses;
    
    /**
     * @ORM\OneToOne(targetEntity="Language", cascade={"persist", "remove"})
     */
    private $language;

    /**
     * @ORM\OneToOne(targetEntity="TaxiCompany", mappedBy="user", cascade={"persist", "remove"})
     */
    private $taxiCompany;

    /**
     * @ORM\OneToOne(targetEntity="TaxiManager", mappedBy="user", cascade={"persist", "remove"})
     */
    private $taxiManager;

    /**
     * @ORM\OneToOne(targetEntity="Driver", mappedBy="user", cascade={"persist", "remove"})
     */
    private $driver;

    /**
     * @ORM\OneToOne(targetEntity="IndependentDriver", mappedBy="user", cascade={"persist", "remove"})
     */
    private $independentDriver;

    /**
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $passwordUpdatedAt;
    
    /**
     * @ORM\Column(type="integer", name="remote_id", nullable=true)
     */
    protected $remoteId;

    /**
     * @ORM\Column(type="decimal", name="fakemoney", nullable=true)
     */
    protected $fakeMoney;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        
//        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Remove Language
     *
     * @param \DaVinci\TaxiBundle\Entity\Language $language
     */
    public function removeUserLanguage(\DaVinci\TaxiBundle\Entity\Language $language)
    {
        $this->language->removeElement($language);
    }

    /**
     * Get Language
     *
     * @return \DaVinci\TaxiBundle\Entity\Language 
     */
    public function getLanguage()
    {
        return $this->language;
    }
    
    /**
     * Set language
     *
     * @param \DaVinci\TaxiBundle\Entity\Language $language
     * @return User
     */
    public function setLanguage(\DaVinci\TaxiBundle\Entity\Language $language)
    {
        $this->language = $language;

        return $this;
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
     * Set taxiCompany
     *
     * @param \DaVinci\TaxiBundle\Entity\TaxiCompany $taxiCompany
     * @return User
     */
    public function setTaxiCompany(\DaVinci\TaxiBundle\Entity\TaxiCompany $taxiCompany = null)
    {
        $this->taxiCompany = $taxiCompany;

        return $this;
    }

    /**
     * Get taxiCompany
     *
     * @return \DaVinci\TaxiBundle\Entity\TaxiCompany 
     */
    public function getTaxiCompany()
    {
        return $this->taxiCompany;
    }

    /**
     * Set taxiManager
     *
     * @param \DaVinci\TaxiBundle\Entity\TaxiManager $taxiManager
     * @return User
     */
    public function setTaxiManager(\DaVinci\TaxiBundle\Entity\TaxiManager $taxiManager = null)
    {
        $this->taxiManager = $taxiManager;

        return $this;
    }

    /**
     * Get taxiManager
     *
     * @return \DaVinci\TaxiBundle\Entity\TaxiManager 
     */
    public function getTaxiManager()
    {
        return $this->taxiManager;
    }

    /**
     * Set driver
     *
     * @param \DaVinci\TaxiBundle\Entity\Driver $driver
     * @return User
     */
    public function setDriver(\DaVinci\TaxiBundle\Entity\Driver $driver = null)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return \DaVinci\TaxiBundle\Entity\Driver 
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set independentDriver
     *
     * @param \DaVinci\TaxiBundle\Entity\IndependentDriver $independentDriver
     * @return User
     */
    public function setIndependentDriver(\DaVinci\TaxiBundle\Entity\IndependentDriver $independentDriver = null)
    {
        $this->independentDriver = $independentDriver;

        return $this;
    }

    /**
     * Get independentDriver
     *
     * @return \DaVinci\TaxiBundle\Entity\IndependentDriver 
     */
    public function getIndependentDriver()
    {
        return $this->independentDriver;
    }
    
    /**
     * Set remoteId
     * 
     * @param int $remoteId
     * @return \DaVinci\TaxiBundle\Entity\User
     */
    public function setRemoteId($remoteId)
    {
    	$this->remoteId = $remoteId;
    	
    	return $this;
    }
    
    /**
     * Get remoteId
     * 
     * @return int
     */
    public function getRemoteId()
    {
    	return $this->remoteId;
    }

    /**
     * Set fakeMoney
     * 
     * @param int $fakeMoney
     * @return \DaVinci\TaxiBundle\Entity\User
     */
    public function setFakeMoney($fakeMoney)
    {
        $bisnesMoney = $this->curentMoney;
        $afterOperationMoney = $bisnesMoney - $fakeMoney;  // Money after operation

        /*#V******************
        kod to    update DB after operation
        ********************/

        $this->fakeMoney = $fakeMoney;
        return $this;
    }
    
    /**
     * Get fakeMoney
     * 
     * @return int
     */
    public function getFakeMoney()
    {
        return $this->fakeMoney;
    }  
          
    // override fosuser function
    public function setPlainPassword($password)
    {
        parent::setPlainPassword($password);
        $this->setPasswordUpdatedAt();
    }
    
    // override fosuser function
    public function setPassword($password)
    {
        parent::setPassword($password);
        $this->setPasswordUpdatedAt();
    }
    
    public function isPasswordNotExpired($expTime = false)
    {
        if (!$expTime) {
            $expTime = $this->timeToUpdatePassword;
        }

        return (
            $this->passwordUpdatedAt instanceof \DateTime 
            && $this->passwordUpdatedAt->getTimestamp() + $expTime > time()
        );
    }
    
    public function setPasswordUpdatedAt($passwordUpdatedAt = false)
    {        
        $this->passwordUpdatedAt = (!$passwordUpdatedAt)
            ? new \DateTime()
            : $passwordUpdatedAt;
    }

    public function getPasswordUpdatedAt()
    {
        $this->passwordUpdatedAt;
    }
    
    public function setFirstname($firstname)
    {
        $this->firstname = ucwords(strtolower($firstname));
    }

    public function setLastname($lastname)
    {
        $this->lastname = ucwords(strtolower($lastname));
    }
    
    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = (Boolean) $termsAccepted;
    }
    
//    /**
//     * Add address
//     *
//     * @param \DaVinci\TaxiBundle\Entity\Address $address
//     * @return User
//     */
//    public function addAddress(\DaVinci\TaxiBundle\Entity\Address $address)
//    {
//        $this->addresses[] = $address;
//
//        return $this;
//    }
//
//    /**
//     * Remove address
//     *
//     * @param \DaVinci\TaxiBundle\Entity\Address $address
//     */
//    public function removeAddress(\DaVinci\TaxiBundle\Entity\Address $address)
//    {
//        $this->addresses->removeElement($address);
//    }
//    
//    /**
//     * set addresses
//     *
//     */
//    public function setAddresses(\Doctrine\Common\Collections\Collection $addresses)
//    {
//        $this->addresses = $addresses;
//        foreach ($addresses as $address) {
//            $address->setUser($this);
//        }
//    }
//
//    /**
//     * Get addresses
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getAddresses()
//    {
//        return $this->addresses;
//    }
        
}

