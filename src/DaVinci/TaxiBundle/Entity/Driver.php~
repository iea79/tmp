<?php
namespace DaVinci\TaxiBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @author Mykola Sedletskyi <icevita@gmail.com>
 */


/**
 * @ORM\Entity
 */
class Driver
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $about;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $experience;

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
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $insuranceAccepted = false;
    
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
     * Set about
     *
     * @param string $about
     * @return Driver
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string 
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set experience
     *
     * @param integer $experience
     * @return Driver
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return integer 
     */
    public function getExperience()
    {
        return $this->experience;
    }

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
    
    public function getInsuranceAccepted()
    {
        return $this->insuranceAccepted;
    }

    public function setInsuranceAccepted ($insuranceAccepted)
    {
        $this->insuranceAccepted = (Boolean) $insuranceAccepted;
    }
    
}
