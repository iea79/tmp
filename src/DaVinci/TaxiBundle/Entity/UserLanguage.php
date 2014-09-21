<?php
namespace DaVinci\TaxiBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;


/**
 * @author Mykola Sedletskyi <icevita@gmail.com>
 */


/**
 * @ORM\Entity
 */
class UserLanguage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(nullable=true)
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $language;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userLanguage")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

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
     * Set level
     *
     * @param string $level
     * @return UserLanguage
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return UserLanguage
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set user
     *
     * @param \DaVinci\TaxiBundle\Entity\User $user
     * @return UserLanguage
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
