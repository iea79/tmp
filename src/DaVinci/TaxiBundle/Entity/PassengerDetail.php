<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;

/**
 * @ORM\Entity
 * @ORM\Table(name="passenger_detail")
 * @FileStore\Uploadable
 */
class PassengerDetail 
{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="integer")
	 * @Assert\Range(
	 * 		groups={"flow_createPassengerRequest_step3", "edit_passenger_request"},
     * 		min=1,
     * 		max=12,
     *      minMessage="Number of adults have to be more or equal {{ limit }}",
     *      maxMessage="Number of adults have to be less or equal {{ limit }}"
     * )
	 */
	private $adult = 0;
	
	/**
	 * @ORM\Column(type="integer")
	 * @Assert\Range(
	 * 		groups={"flow_createPassengerRequest_step3", "edit_passenger_request"},
     * 		min=0,
     * 		max=12,
     *      minMessage="Number of children have to be more or equal {{ limit }}",
     *      maxMessage="Number of children have to be less or equal {{ limit }}"
     * )
	 */
	private $children = 0;
	
	/**
	 * @ORM\Column(type="integer")
	 * @Assert\Range(
	 * 		groups={"flow_createPassengerRequest_step3", "edit_passenger_request"},
     * 		min=0,
     * 		max=12,
     *      minMessage="Number of seniors have to be more or equal {{ limit }}",
     *      maxMessage="Number of seniors have to be less or equal {{ limit }}"
     * )
	 */
	private $seniors = 0;
	
    /**
     * @ORM\Column(type="array")
     * @Assert\Image(
     * 		groups={"flow_createPassengerRequest_step3", "edit_passenger_request"},
     * 		maxSize="1024K",
     * 		minWidth=200,
     *     	maxWidth=1600,
     *     	minHeight=200,
     *     	maxHeight=1200
     * )
     * @FileStore\UploadableField(mapping="picture")
     */
    private $picture;
	
	/**
	 * @ORM\Column(type="boolean", name="not_my_self")
	 */
	private $notMySelf = false;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @Assert\NotBlank(groups={"flow_createPassengerRequest_step3", "edit_passenger_request"}, message="passengerDetail.name.blank")
	 */
	private $name;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @Assert\NotBlank(groups={"flow_createPassengerRequest_step3", "edit_passenger_request"}, message="passengerDetail.email.blank")
	 * @Assert\Email(
	 * 		groups={"flow_createPassengerRequest_step3", "edit_passenger_request"},
     * 		message="The email '{{ value }}' is not a valid email."
     * )
	 */
	private $email;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $skype;
	
	/**
	 * @ORM\Column(type="integer", name="mobile_code")
	 * @Assert\Range(
	 * 		groups={"flow_createPassengerRequest_step3", "edit_passenger_request"},
     *		min=0,
     *      max=999,    
     *		minMessage="The code must be greater then 0"
     * )
	 */
	private $mobileCode = 0;
	
	/**
	 * @ORM\Column(type="string", name="mobile_phone", nullable=true, length=20)
     * @Assert\NotBlank(groups={"flow_createPassengerRequest_step3", "edit_passenger_request"}, message="passengerDetail.mobilePhone.blank")
	 * @Assert\Regex(
	 *		groups={"flow_createPassengerRequest_step3", "edit_passenger_request"}, 		
     *     	pattern="/^\+[0-9]{9,15}$/",
     *     	match=true,
     *     	message="Your phone number has incorrect format"
     * )
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
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $about;
	
	/**
	 * @ORM\OneToOne(targetEntity="PassengerRequest", inversedBy="passengerDetail")
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
     * Sets picture
     *
     * @param array $picture
     * @return PassengerDetail
     */
    public function setPicture($picture)
    {
    	$this->picture = $picture;
    	
    	return $this;
    }
    
    /**
     * Get picture
     *
     * @return array
     */
    public function getPicture()
    {
    	return $this->picture;
    }
        
    /**
     * Set notMySelf
     *
     * @param boolean $notMySelf
     * @return PassengerDetail
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
     * @return PassengerDetail
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
     * @return PassengerDetail
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
     * @return PassengerDetail
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
     * @return PassengerDetail
     */
    public function setMobileCode($mobileCode)
    {
    	if (is_null($mobileCode)) {
    		return $this;
    	}
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
     * @return PassengerDetail
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
     * @return PassengerDetail
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
     * @return PassengerDetail
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
     * @return PassengerDetail
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
