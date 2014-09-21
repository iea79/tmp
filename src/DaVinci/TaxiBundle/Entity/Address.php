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
     * @ORM\ManyToOne(targetEntity="DaVinci\TaxiBundle\Entity\City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     * @Assert\Type("DaVinci\TaxiBundle\Entity\City")
     * @Assert\NotNull()
     */
    private $city;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $postcode;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="address")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

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
     * Set city
     *
     * @param \DaVinci\TaxiBundle\Entity\City $city
     * @return Address
     */
    public function setCity(\DaVinci\TaxiBundle\Entity\City $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \DaVinci\TaxiBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Address
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
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

    /**
     * Set user
     *
     * @param \DaVinci\TaxiBundle\Entity\User $user
     * @return Address
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
