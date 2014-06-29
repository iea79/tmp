<?php
namespace DaVinci\TaxiBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Language
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="UserLanguage", mappedBy="language")
     */
    private $userLanguage;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userLanguage = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Language
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
     * Set status
     *
     * @param integer $status
     * @return Language
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
     * Add userLanguage
     *
     * @param \DaVinci\TaxiBundle\Entity\UserLanguage $userLanguage
     * @return Language
     */
    public function addUserLanguage(\DaVinci\TaxiBundle\Entity\UserLanguage $userLanguage)
    {
        $this->userLanguage[] = $userLanguage;

        return $this;
    }

    /**
     * Remove userLanguage
     *
     * @param \DaVinci\TaxiBundle\Entity\UserLanguage $userLanguage
     */
    public function removeUserLanguage(\DaVinci\TaxiBundle\Entity\UserLanguage $userLanguage)
    {
        $this->userLanguage->removeElement($userLanguage);
    }

    /**
     * Get userLanguage
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserLanguage()
    {
        return $this->userLanguage;
    }
}
