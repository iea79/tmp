<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Intl\Intl;

/**
 * @ORM\Entity
 */
class Country {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * We will get name from sonata country i18n {{ 'FR' | country }} 
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $countryCode;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set iso_code_2
     *
     * @param string $isoCode2
     * @return Country
     */
    public function setCountryCode($isoCode2) {
        $this->countryCode = $isoCode2;

        return $this;
    }

    /**
     * Get iso_code_2
     *
     * @return string 
     */
    public function getCountryCode() {
        return $this->countryCode;
    }

    /**
     * Add address
     *
     * @param \DaVinci\TaxiBundle\Entity\Address $address
     * @return Country
     */
    public function addAddress(\DaVinci\TaxiBundle\Entity\Address $address) {
        $this->address[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \DaVinci\TaxiBundle\Entity\Address $address
     */
    public function removeAddress(\DaVinci\TaxiBundle\Entity\Address $address) {
        $this->address->removeElement($address);
    }

    /**
     * Get address
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddress() {
        return $this->address;
    }

    public function __toString() {
        return Intl::getRegionBundle()->getCountryName($this->countryCode);
    }

}
