<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="passenger_detail")
 */
class PassengerDetail {
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	private $adult = 0;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	private $children = 0;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	private $seniors = 0;
	
	/**
	 * @ORM\Column(type="boolean", name="not_my_self")
	 */
	private $notMySelf = false;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $email;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $skype;
	
	/**
	 * @ORM\Column(type="integer", name="mobile_code")
	 */
	private $mobileCode;
	
	/**
	 * @ORM\Column(type="string", name="mobile_phone", length=20)
	 */
	private $mobilePhone;
	
	/**
	 * @ORM\Column(type="boolean", name="mobile_has_wifi")
	 */
	private $mobileHasWifi = false;
	
	/**
	 * @ORM\Column(type="boolean", name="mobile_has_whatsapp")
	 */
	private $mobileHasWhatsapp = false;
	
	/**
	 * @ORM\Column(type="text")
	 */
	private $about;
	
	/**
	 * @ORM\OneToOne(targetEntity="PassengerRequest")
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
     * Set adult
     *
     * @param integer $adult
     * @return PassengerDetail
     */
    public function setAdult($adult)
    {
        $this->adult = $adult;

        return $this;
    }

    /**
     * Get adult
     *
     * @return integer 
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * Set children
     *
     * @param integer $children
     * @return PassengerDetail
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Get children
     *
     * @return integer 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set seniors
     *
     * @param integer $seniors
     * @return PassengerDetail
     */
    public function setSeniors($seniors)
    {
        $this->seniors = $seniors;

        return $this;
    }

    /**
     * Get seniors
     *
     * @return integer 
     */
    public function getSeniors()
    {
        return $this->seniors;
    }
    
    /**
     * Set notMySelf
     *
     * @param boolean $notMySelf
     * @return PassengerRelated
     */
    public function setNotMySelf($notMySelf)
    {
    	$this->notMySelf = $notMySelf;
    
    	return $this;
    }
    
    /**
     * Get notMySelf
     *
     * @return boolean
     */
    public function getNotMySelf()
    {
    	return $this->notMySelf;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return PassengerRelated
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
     * Set email
     *
     * @param string $email
     * @return PassengerRelated
     */
    public function setEmail($email)
    {
    	$this->email = $email;
    
    	return $this;
    }
    
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
    	return $this->email;
    }
    
    /**
     * Set skype
     *
     * @param string $skype
     * @return PassengerRelated
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
     * Set mobileCode
     *
     * @param integer $mobileCode
     * @return PassengerRelated
     */
    public function setMobileCode($mobileCode)
    {
    	$this->mobileCode = $mobileCode;
    
    	return $this;
    }
    
    /**
     * Get mobileCode
     *
     * @return integer
     */
    public function getMobileCode()
    {
    	return $this->mobileCode;
    }
    
    /**
     * Set mobilePhone
     *
     * @param integer $mobilePhone
     * @return PassengerRelated
     */
    public function setMobilePhone($mobilePhone)
    {
    	$this->mobilePhone = $mobilePhone;
    
    	return $this;
    }
    
    /**
     * Get mobilePhone
     *
     * @return integer
     */
    public function getMobilePhone()
    {
    	return $this->mobilePhone;
    }
    
    /**
     * Set mobileHasWifi
     *
     * @param boolean $mobileHasWifi
     * @return PassengerRelated
     */
    public function setMobileHasWifi($mobileHasWifi)
    {
    	$this->mobileHasWifi = $mobileHasWifi;
    
    	return $this;
    }
    
    /**
     * Get mobileHasWifi
     *
     * @return boolean
     */
    public function getMobileHasWifi()
    {
    	return $this->mobileHasWifi;
    }
    
    /**
     * Set mobileHasWhatsapp
     *
     * @param boolean $mobileHasWhatsapp
     * @return PassengerRelated
     */
    public function setMobileHasWhatsapp($mobileHasWhatsapp)
    {
    	$this->mobileHasWhatsapp = $mobileHasWhatsapp;
    
    	return $this;
    }
    
    /**
     * Get mobileHasWhatsapp
     *
     * @return boolean
     */
    public function getMobileHasWhatsapp()
    {
    	return $this->mobileHasWhatsapp;
    }
    
    /**
     * Set about
     *
     * @param string $about
     * @return PassengerRelated
     */
    public function setAbout($about)
    {
    	$this->about = $about;
    
    	return $this;
    }
    
    /**
     * Get about
     *
     * @return string
     */
    public function getAbout()
    {
    	return $this->about;
    }
    
    /**
     * Set passengerRequest
     *
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
     * @return PassengerDetail
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
