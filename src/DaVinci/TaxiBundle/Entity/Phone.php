<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Phone
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(groups={"flow_taxi_independent_driver_registration_step1"}, message="phones.phone.blank")
     */
    protected $phone;
    
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $has_internet = false;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $has_whatsapp = false;
    
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
     * Set phone
     *
     * @param string $name
     * @return TaxiCompany
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * Get has_internet
     *
     * @return boolean
     */
    public function hasInternet()
    {
        return $this->has_internet;
    }

    /**
     * Get has_whatsapp
     *
     * @return boolean
     */
    public function hasWhatsapp()
    {
        return $this->has_whatsapp;
    }
    

    /**
     * Set has_internet
     *
     * @param boolean $hasInternet
     * @return Phone
     */
    public function setHasInternet($hasInternet)
    {
        $this->has_internet = $hasInternet;

        return $this;
    }

    /**
     * Get has_internet
     *
     * @return boolean 
     */
    public function getHasInternet()
    {
        return $this->has_internet;
    }

    /**
     * Set has_whatsapp
     *
     * @param boolean $hasWhatsapp
     * @return Phone
     */
    public function setHasWhatsapp($hasWhatsapp)
    {
        $this->has_whatsapp = $hasWhatsapp;

        return $this;
    }

    /**
     * Get has_whatsapp
     *
     * @return boolean 
     */
    public function getHasWhatsapp()
    {
        return $this->has_whatsapp;
    }
    
}
