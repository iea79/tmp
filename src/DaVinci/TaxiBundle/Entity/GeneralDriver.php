<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="general_drivers")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(type="string", name="discriminator_type")
 * @ORM\DiscriminatorMap({"driver"="Driver", "independent_driver"="IndependentDriver"})
 */
abstract class GeneralDriver 
{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="text", nullable=true)
	 * @Assert\Length(
	 * 		groups={"flow_taxi_independent_driver_registration_step1"},
	 * 		max=200, 
	 * 		maxMessage="independent.about.max"
	 * )
	 */
	protected $about;
	
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 * @Assert\NotBlank(groups={"flow_taxi_independent_driver_registration_step1"}, message="independent.experience.blank")
	 */
	protected $experience;
	
	/**
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	protected $insuranceAccepted = false;
	
	/**
	 * @ORM\ManyToMany(targetEntity="PassengerRequest", mappedBy="possibleDrivers")
	 */
	protected $possibleRequests;
	
	/**
	 * @ORM\ManyToMany(targetEntity="PassengerRequest", mappedBy="canceledDrivers")
	 */
	protected $canceledRequests;
	
	public function __construct()
	{
		$this->possibleRequests = new ArrayCollection();
		$this->canceledRequests = new ArrayCollection();
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
	 * Set about
	 *
	 * @param string $about
	 * @return IndependentDriver
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
	 * @return IndependentDriver
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
	
	public function setInsuranceAccepted($insuranceAccepted)
	{
		$this->insuranceAccepted = (Boolean) $insuranceAccepted;
	}
	
	public function getInsuranceAccepted()
	{
		return $this->insuranceAccepted;
	}
	
	/**
	 * Add possibleRequests
	 *
	 * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
	 * @return GeneralDriver
	 */
	public function addPossibleRequests(\DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest)
	{
		$this->possibleRequests[] = $passengerRequest;
	
		return $this;
	}
	
	/**
	 * Remove possibleRequests
	 *
	 * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
	 */
	public function removePossibleRequests(\DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest)
	{
		$this->possibleRequests->removeElement($passengerRequest);
	}
	
	/**
	 * Get possibleRequests
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getPossibleRequests()
	{
		return $this->possibleRequests;
	}
	
	/**
	 * Add canceledRequests
	 *
	 * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
	 * @return GeneralDriver
	 */
	public function addCanceledRequests(\DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest)
	{
		$this->canceledRequests[] = $passengerRequest;
	
		return $this;
	}
	
	/**
	 * Remove canceledRequests
	 *
	 * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest
	 */
	public function removeCanceledRequests(\DaVinci\TaxiBundle\Entity\PassengerRequest $passengerRequest)
	{
		$this->canceledRequests->removeElement($passengerRequest);
	}
	
	/**
	 * Get canceledRequests
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getCanceledRequests()
	{
		return $this->canceledRequests;
	}
		
}

?>