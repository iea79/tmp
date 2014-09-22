<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

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
     * @ORM\Column(type="string", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $iso_code_2;

    /**
     * @ORM\Column(type="integer", length=1, nullable=true, options={"default":1})
     */
    private $status;

    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    protected $slug;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Country
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param  string  $slug
     * @return Country
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set iso_code_2
     *
     * @param string $isoCode2
     * @return Country
     */
    public function setIsoCode2($isoCode2) {
        $this->iso_code_2 = $isoCode2;

        return $this;
    }

    /**
     * Get iso_code_2
     *
     * @return string 
     */
    public function getIsoCode2() {
        return $this->iso_code_2;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Country
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus() {
        return $this->status;
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
        return $this->name;
    }

}
