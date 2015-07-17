<?php

namespace DaVinci\TaxiBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping AS ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="UserCommentRepository")
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
    
    const FOR_PASSENGER = 'passengers';
    const FOR_DRIVERS = 'drivers';
    const FOR_COMPANIES = 'companies';
    
    const RATE_FIRST = 1;
    const RATE_SECOND = 2;
    const RATE_THIRD = 3;
    const RATE_FOURTH = 4;
    const RATE_FIFTH = 5;
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(groups={"user_comment"}, message="userComment.blank")
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
    
    /**
     * @ORM\Column(type="integer", name="rate_level")
     * @Assert\Range(
     *      groups={"user_comment"}, 
     *      min=1,
     * 		max=5,
     *      minMessage="Rate have to be more or equal {{ limit }}",
     *      maxMessage="Rate have to be less or equal {{ limit }}"
     * )
     */
    protected $rateLevel = 0;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
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
    
    /**
     * Set rateLevel
     *
     * @param integer $rateLevel
     *
     * @return UserComment
     */
    public function setRateLevel($rateLevel)
    {
        $this->rateLevel = $rateLevel;

        return $this;
    }

    /**
     * Get rateLevel
     *
     * @return integer
     */
    public function getRateLevel()
    {
        return $this->rateLevel;
    }
    
    public function setTypeByColumn($column)
    {
        $columnList = self::getTypeColumns();
        
        if (!in_array($column, $columnList)) {
            throw new \InvalidArgumentException(get_class($this) . ": undefined review column #{$column}");
        }
        
        $this->type = array_search($column, $columnList);
        
        return $this;
    }
    
    static public function getTypeByColumn($column)
    {
        $columnList = self::getTypeColumns();
        
        if (!in_array($column, $columnList)) {
            throw new \InvalidArgumentException(get_class($this) . ": undefined review column #{$column}");
        }
        
        return array_search($column, $columnList);
    }
        
    public static function getTypeColumnList()
    {
    	return array(
    		self::FOR_PASSENGER => 'From passengers',
    		self::FOR_DRIVERS => 'From drivers',
    		self::FOR_COMPANIES => 'From taxi companies'
    	);
    }
    
    public static function getTypeColumns()
    {
    	return array(
    		self::TYPE_PASSENGER => self::FOR_PASSENGER,
    		self::TYPE_DRIVER => self::FOR_DRIVERS,
    		self::TYPE_TAXI_COMPANY => self::FOR_COMPANIES
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
    		self::STATUS_VALID    => 'Valid',
    		self::STATUS_INVALID  => 'Invalid',
    		self::STATUS_MODERATE => 'Moderate',
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
        $state = $this->getState();
    
    	return isset($list[$state])
	    	? $list[$state]
	    	: null;
    }
    
    static public function getRateList()
    {
        return array(
            self::RATE_FIRST => '1 star',
            self::RATE_SECOND => '2 stars',
            self::RATE_THIRD => '3 stars',
            self::RATE_FOURTH => '4 stars',
            self::RATE_FIFTH => '5 stars'
        );
    }
    
    public function getRateLabel()
    {
    	$list = self::getRates();
        $rate = $this->getRateLevel();
    
    	return isset($list[$rate])
	    	? $list[$rate]
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
