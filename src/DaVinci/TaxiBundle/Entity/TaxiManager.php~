<?php
namespace DaVinci\TaxiBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class TaxiManager
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="TaxiCompany", inversedBy="manager")
     * @ORM\JoinColumn(name="taxi_company_id", referencedColumnName="id", nullable=false)
     */
    private $taxiCompany;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="taxiManager")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Set id
     *
     * @param integer $id
     * @return TaxiManager
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set taxiCompany
     *
     * @param \DaVinci\TaxiBundle\Entity\TaxiCompany $taxiCompany
     * @return TaxiManager
     */
    public function setTaxiCompany(\DaVinci\TaxiBundle\Entity\TaxiCompany $taxiCompany)
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
     * @return TaxiManager
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
