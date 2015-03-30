<?php

namespace DaVinci\TaxiBundle\Entity;

/**
 * @author Mykola Sedletskyi <icevita@gmail.com>
 */

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping AS ORM;


/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class UserComment
{
    /**
     * Available comment status
     */
    const STATUS_MODERATE = 0;
    const STATUS_VALID    = 1;
    const STATUS_INVALID  = 2;

    /**
     * Available comment types
     */
    const TYPE_PASSENGER = 0;
    const TYPE_DRIVER    = 1;
    const TYPE_TAXI_COMPANY  = 2;    
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $text;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    /** 
     * @var datetime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;
 
    /**
     * Current type of the comment.
     *
     * @ORM\Column(type="integer")
     */
    protected $type = 0;
    
    /**
     * Current state of the comment.
     *
     * @ORM\Column(type="integer")
     */
    protected $state = 0;

    /**
     * The previous state of the comment.
     *
     * @ORM\Column(type="integer")
     */
    protected $previousState = 0;
    
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Return the comment unique id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    function getType()
    {
        return $this->type;
    }

    function setType($type)
    {
        $this->type = $type;
    }

    function getState()
    {
        return $this->state;
    }

    
    function getText()
    {
        return $this->text;
    }

    function setText($text)
    {
        $this->text = $text;
    }

    function getUser()
    {
        return $this->user;
    }

    function setUser($user)
    {
        $this->user = $user;
    }

    public static function getTypeList()
    {
        return array(
            self::TYPE_PASSENGER => 'from passenger',
            self::TYPE_DRIVER    => 'from driver',
            self::TYPE_TAXI_COMPANY  => 'from taxi compan' 
        );
    }
    
    /**
     * Returns comment state list
     *
     * @return array
     */
    public static function getStateList()
    {
        return array(
            self::STATUS_VALID    => 'valid',
            self::STATUS_INVALID  => 'invalid',
            self::STATUS_MODERATE => 'moderate',
        );
    }

    /**
     * Returns comment state label
     *
     * @return integer|null
     */
    public function getStateLabel()
    {
        $list = self::getStateList();
        return isset($list[$this->getState()]) ? $list[$this->getState()] : null;
    }
    
    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * Sets the creation date
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
        return 'Comment #'.$this->getId();
    }
    
    public function setState($state)
    {
        $this->previousState = $this->state;
        $this->state = $state;
    }

    public function getPreviousState()
    {
        return $this->previousState;
    }
}