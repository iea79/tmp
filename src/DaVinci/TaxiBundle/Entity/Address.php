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
class Address
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\DaVinci\TaxiBundle\Entity\Admin\CountryCity", inversedBy="address")
     * @ORM\JoinColumn(name="countrycity_id", referencedColumnName="id")
     **/
    private $countrycity;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $street;
    

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $postcode;

//    /**
//     * @ORM\ManyToOne(targetEntity="User", inversedBy="addresses")
//     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
//     */
//    private $user;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    
    public function getCountry()
    {
        return $this->countrycity->getCountry();
    }
    
    /**
     * Set countrycit
     *
     * @param string $countrycity
     * @return Address
     */
    public function setCountrycity($countrycity)
    {
        $this->countrycity = $countrycity;

        return $this;
    }

    /**
     * Get countrycit
     *
     * @return CountryCity
     */
    public function getCountrycity()
    {
        return $this->countrycity;
    }
    


    /**
     * Set street
     *
     * @param string $address
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return Address
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

//    /**
//     * Set user
//     *
//     * @param \DaVinci\TaxiBundle\Entity\User $user
//     * @return Address
//     */
//    public function setUser(\DaVinci\TaxiBundle\Entity\User $user = null)
//    {
//        $this->user = $user;
//
//        return $this;
//    }
//
//    /**
//     * Get user
//     *
//     * @return \DaVinci\TaxiBundle\Entity\User 
//     */
//    public function getUser()
//    {
//        return $this->user;
//    }

}