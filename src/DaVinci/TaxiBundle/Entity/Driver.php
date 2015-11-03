<?php
namespace DaVinci\TaxiBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @author Mykola Sedletskyi <icevita@gmail.com>
 */

/**
 * @ORM\Entity
 */
class Driver extends GeneralDriver
{

    /**
     * @ORM\ManyToOne(targetEntity="TaxiCompany", inversedBy="driver")
     * @ORM\JoinColumn(name="taxi_company_id", referencedColumnName="id")
     */
    private $taxiCompany;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="driver")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
        
    /**
     * Set taxiCompany
     *
     * @param \DaVinci\TaxiBundle\Entity\TaxiCompany $taxiCompany
     * @return Driver
     */
    public function setTaxiCompany(\DaVinci\TaxiBundle\Entity\TaxiCompany $taxiCompany = null)
    {
        $this->taxiCompany = $taxiCompany;

        return $this;
    }

    /**
     * Get taxiCompany
     *
     * @return \DaVinci\TaxiBundle\Entity\TaxiCompany 
     */
    public function getTaxiCompany()
    {
        return $this->taxiCompany;
    }

    /**
     * Set user
     *
     * @param \DaVinci\TaxiBundle\Entity\User $user
     * @return Driver
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
