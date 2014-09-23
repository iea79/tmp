<?php
namespace DaVinci\TaxiBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Country
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $iso_code_2;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $iso_code_3;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $address_format;

    /**
     * @ORM\Column(type="integer", length=1, nullable=true, options={"default":1})
     */
    private $postcode_required;

    /**
     * @ORM\Column(type="integer", length=1, nullable=true, options={"default":1})
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="country")
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="Zone", mappedBy="country")
     */
    private $zone;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->address = new \Doctrine\Common\Collections\ArrayCollection();
        $this->zone = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Country
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
     * Set iso_code_2
     *
     * @param string $isoCode2
     * @return Country
     */
    public function setIsoCode2($isoCode2)
    {
        $this->iso_code_2 = $isoCode2;

        return $this;
    }

    /**
     * Get iso_code_2
     *
     * @return string 
     */
    public function getIsoCode2()
    {
        return $this->iso_code_2;
    }

    /**
     * Set iso_code_3
     *
     * @param string $isoCode3
     * @return Country
     */
    public function setIsoCode3($isoCode3)
    {
        $this->iso_code_3 = $isoCode3;

        return $this;
    }

    /**
     * Get iso_code_3
     *
     * @return string 
     */
    public function getIsoCode3()
    {
        return $this->iso_code_3;
    }

    /**
     * Set address_format
     *
     * @param string $addressFormat
     * @return Country
     */
    public function setAddressFormat($addressFormat)
    {
        $this->address_format = $addressFormat;

        return $this;
    }

    /**
     * Get address_format
     *
     * @return string 
     */
    public function getAddressFormat()
    {
        return $this->address_format;
    }

    /**
     * Set postcode_required
     *
     * @param integer $postcodeRequired
     * @return Country
     */
    public function setPostcodeRequired($postcodeRequired)
    {
        $this->postcode_required = $postcodeRequired;

        return $this;
    }

    /**
     * Get postcode_required
     *
     * @return integer 
     */
    public function getPostcodeRequired()
    {
        return $this->postcode_required;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Country
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add address
     *
     * @param \DaVinci\TaxiBundle\Entity\Address $address
     * @return Country
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

    /**
     * Add zone
     *
     * @param \DaVinci\TaxiBundle\Entity\Zone $zone
     * @return Country
     */
    public function addZone(\DaVinci\TaxiBundle\Entity\Zone $zone)
    {
        $this->zone[] = $zone;

        return $this;
    }

    /**
     * Remove zone
     *
     * @param \DaVinci\TaxiBundle\Entity\Zone $zone
     */
    public function removeZone(\DaVinci\TaxiBundle\Entity\Zone $zone)
    {
        $this->zone->removeElement($zone);
    }

    /**
     * Get zone
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getZone()
    {
        return $this->zone;
    }
}
