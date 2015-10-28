<?php
namespace DaVinci\TaxiBundle\Entity\Admin;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\Index;
use Symfony\Component\Intl\Intl;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Mykola Sedletskyi <icevita@gmail.com>
 */

/**
 * @ORM\Entity(repositoryClass="DaVinci\TaxiBundle\Entity\Admin\CountryCityRepository")
 * @ORM\Table(indexes={@ORM\Index(name="country_code_idx", columns={"countryCode"})})
 */
class CountryCity
{
    use \A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     * We will get name from sonata country i18n {{ 'FR' | country }} 
     * @ORM\Column(type="string", length=2)
     */
    protected $countryCode;
    
    /**
     * @ORM\Column(type="integer", length=1, nullable=true, options={"default":1})
     */
    private $status;

    protected $translations;
    
    /**
     * @ORM\OneToMany(targetEntity="\DaVinci\TaxiBundle\Entity\Address", mappedBy="countrycity")
     **/
    private $address;
    
    public function __construct() {
        $this->address = new ArrayCollection();
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /* for sonata admin list*/
    public function getCity()
    {
        $translations = $this->getCurrentTranslation();
        return $translations->getCity();
    }
    
    /* for form's entity*/
    public function getCountry()
    {
        return Intl::getRegionBundle()->getCountryName($this->countryCode);
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
     * Set countryCode
     *
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * Get countryCode
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
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
    
    public function __toString()
    {
        $translations = $this->getCurrentTranslation();
        if($translations)
            return $translations->getCity();
        else
            return '';
    }

    /**
     * Add address
     *
     * @param \DaVinci\TaxiBundle\Entity\Address $address
     * @return CountryCity
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
}
