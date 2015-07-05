<?php

namespace DaVinci\TaxiBundle\Entity;

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
    const TYPE_PASSENGER 	= 0;
    const TYPE_DRIVER    	= 1;
    const TYPE_TAXI_COMPANY = 2;    
    
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
    protected $user;
    
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
    
    /**
     * Set text
     *
     * @param string $text
     *
     * @return UserComment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return UserComment
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return UserComment
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return UserComment
     */
    public function setState($state)
    {
    	$this->previousState = $this->state;
    	$this->state = $state;
    
    	return $this;
    }
    
    /**
     * Get state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }
    
    /**
     * Set previousState
     *
     * @param integer $previousState
     *
     * @return UserComment
     */
    public function setPreviousState($previousState)
    {
        $this->previousState = $previousState;

        return $this;
    }

    /**
     * Get previousState
     *
     * @return integer
     */
    public function getPreviousState()
    {
        return $this->previousState;
    }

    /**
     * Set user
     *
     * @param \DaVinci\TaxiBundle\Entity\User $user
     *
     * @return UserComment
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
    
    	return isset($list[$this->getState()])
	    	? $list[$this->getState()]
	    	: null;
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
    	return 'Comment #' . $this->getId();
    }
    
}
