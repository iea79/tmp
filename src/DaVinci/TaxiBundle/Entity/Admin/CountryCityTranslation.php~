<?php
namespace DaVinci\TaxiBundle\Entity\Admin;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Mykola Sedletskyi <icevita@gmail.com>
 */

/**
 * @ORM\Entity
 */
class CountryCityTranslation
{
    use \A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    protected $city;

    /**
     * Set city
     *
     * @param string $city
     * 
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
}
