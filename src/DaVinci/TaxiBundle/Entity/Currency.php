<?php
namespace DaVinci\TaxiBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @author Mykola Sedletskyi <icevita@gmail.com>
 */


/**
 * @ORM\Entity
 */
class Currency
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="float", length=15, nullable=true)
     */
    private $value;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_modified;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="currency")
     */
    private $user;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Currency
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
     * Set code
     *
     * @param string $code
     * @return Currency
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set value
     *
     * @param float $value
     * @return Currency
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Currency
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
     * Set date_modified
     *
     * @param \DateTime $dateModified
     * @return Currency
     */
    public function setDateModified($dateModified)
    {
        $this->date_modified = $dateModified;

        return $this;
    }

    /**
     * Get date_modified
     *
     * @return \DateTime 
     */
    public function getDateModified()
    {
        return $this->date_modified;
    }

    /**
     * Add user
     *
     * @param \DaVinci\TaxiBundle\Entity\User $user
     * @return Currency
     */
    public function addUser(\DaVinci\TaxiBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \DaVinci\TaxiBundle\Entity\User $user
     */
    public function removeUser(\DaVinci\TaxiBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }
}
