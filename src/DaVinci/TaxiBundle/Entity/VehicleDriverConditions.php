<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Component\Intl\Intl;

/**
 * @ORM\Entity
 * @ORM\Table(name="vehicle_driver_conditions")
 * @Assert\Callback(methods={"validateInterpreterLanguage"}, groups={"flow_createPassengerRequest_step2", "edit_passenger_request"})
 */
class VehicleDriverConditions 
{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", name="interpreter_lang", length=255, nullable=true)
	 */
	private $interpreterLang;
		
	/**
	 * @ORM\Column(type="boolean")
	 */
	private $educator = false;
	
	/**
	 * @ORM\Column(type="boolean", name="medical_license")
	 */
	private $medicalLicense = false;
	
	/**
	 * @ORM\Column(type="boolean", name="body_guard")
	 */
	private $bodyGuard = false;
	
	/**
	 * @ORM\Column(type="boolean", name="animal_trainer")
	 */
	private $animalTrainer = false;
	
	/**
	 * @ORM\Column(type="boolean")
	 */
	private $carrier = false;
	
	/**
	 * @ORM\Column(type="boolean")
	 */
	private $guide = false;
		
	/**
	 * @ORM\OneToOne(targetEntity="PassengerRequest", inversedBy="vehicleDriverConditions")
	 * @ORM\JoinColumn(name="request_id", referencedColumnName="id")
	 */
	private $passengerRequest;
    
    private $needInterpreter;
	
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
     * Set interpreterLang
     *
     * @param string $interpreterLang
     * @return VehicleDriverConditions
     */
    public function setInterpreterLang($interpreterLang)
    {
        $this->interpreterLang = $interpreterLang;

        return $this;
    }

    /**
     * Get interpreterLang
     *
     * @return string
     */
    public function getInterpreterLang()
    {
        return Intl::getLanguageBundle()->getLanguageName($this->interpreterLang);
    }
    
    /**
     * Set educator
     *
     * @param boolean $educator
     * @return VehicleDriverConditions
     */
    public function setEducator($educator)
    {
        $this->educator = $educator;

        return $this;
    }

    /**
     * Get educator
     *
     * @return boolean 
     */
    public function getEducator()
    {
        return $this->educator;
    }

    /**
     * Set medicalLicense
     *
     * @param boolean $medicalLicense
     * @return VehicleDriverConditions
     */
    public function setMedicalLicense($medicalLicense)
    {
        $this->medicalLicense = $medicalLicense;

        return $this;
    }

    /**
     * Get medicalLicense
     *
     * @return boolean 
     */
    public function getMedicalLicense()
    {
        return $this->medicalLicense;
    }

    /**
     * Set bodyGuard
     *
     * @param boolean $bodyGuard
     * @return VehicleDriverConditions
     */
    public function setBodyGuard($bodyGuard)
    {
        $this->bodyGuard = $bodyGuard;

        return $this;
    }

    /**
     * Get bodyGuard
     *
     * @return boolean 
     */
    public function getBodyGuard()
    {
        return $this->bodyGuard;
    }

    /**
     * Set animalTrainer
     *
     * @param boolean $animalTrainer
     * @return VehicleDriverConditions
     */
    public function setAnimalTrainer($animalTrainer)
    {
        $this->animalTrainer = $animalTrainer;

        return $this;
    }

    /**
     * Get animalTrainer
     *
     * @return boolean 
     */
    public function getAnimalTrainer()
    {
        return $this->animalTrainer;
    }

    /**
     * Set carrier
     *
     * @param boolean $carrier
     * @return VehicleDriverConditions
     */
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return boolean 
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set guide
     *
     * @param boolean $guide
     * @return VehicleDriverConditions
     */
    public function setGuide($guide)
    {
        $this->guide = $guide;

        return $this;
    }

    /**
     * Get guide
     *
     * @return boolean 
     */
    public function getGuide()
    {
        return $this->guide;
    }

    /**
     * Set passengerRequest
     *
     * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
     * @return VehicleDriverConditions
     */
    public function setPassengerRequest(\DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest = null)
    {
        $this->passengerRequest = $passengerRequest;

        return $this;
    }

    /**
     * Get passengerRequest
     *
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequest 
     */
    public function getPassengerRequest()
    {
        return $this->passengerRequest;
    }
    
    public function setNeedInterpreter($needInterpreter)
    {
        $this->needInterpreter = $needInterpreter;

        return $this;
    }
    
    public function getNeedInterpreter()
    {
        return $this->needInterpreter;
    }
    
    public function validateInterpreterLanguage(ExecutionContextInterface $context)
    {
        if ($this->getNeedInterpreter() && is_null($this->getInterpreterLang())) {
            $context->buildViolation('Language has to be choosen')
                ->atPath('interpreterLang')
                ->addViolation();
        }
    }
    
}
