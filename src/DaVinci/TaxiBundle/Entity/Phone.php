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
     */
    private $phone;
    
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $has_internet;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $has_whatsapp;
    
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
    
}