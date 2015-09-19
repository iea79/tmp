<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

use DaVinci\TaxiBundle\Event\SystemEvents;
use DaVinci\TaxiBundle\Entity\User;

/**
 * @ORM\Entity(repositoryClass="InternalMessageRepository")
 * @ORM\Table(name="internal_message")
 */
class InternalMessage 
{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="datetimetz", name="create_date")
	 */
	private $createDate;
	
	/**
	 * @ORM\Column(type="string", columnDefinition="ENUM('Low', 'Normal', 'High', 'Urgent', 'Immediate')", length=50)
	 */
	private $priority = InternalMessagePriorities::NORMAL;
    
    /**
	 * @ORM\Column(type="string", columnDefinition="ENUM('approve.request', 'decline-driver.request', 'cancel.request')", name="literal_code", length=100)
	 */
	private $literalCode;
    
    /**
	 * @ORM\Column(type="string", length=255)
	 */
	private $subject;
	
	/**
	 * @ORM\Column(type="text")
	 */
	private $content;
	
	/**
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	private $user;
    
    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('user', 'taxi-independent-driver', 'taxi-company-driver')", length=50)
     */
    private $office;

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
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return InternalMessage
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set priority
     *
     * @param string $priority
     *
     * @return InternalMessage
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }
    
    /**
     * Set literalCode
     *
     * @param string $literalCode
     *
     * @return MessageContent
     */
    public function setLiteralCode($literalCode)
    {
        $this->literalCode = $literalCode;

        return $this;
    }

    /**
     * Get literalCode
     *
     * @return string
     */
    public function getLiteralCode()
    {
        return $this->literalCode;
    }
    
    public function getEventName()
    {
        return SystemEvents::getEventByLiteralCode($this->literalCode);
    }
    
    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return MessageContent
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return InternalMessage
     */
    public function setContent($content)
    {
    	$this->content = $content;
    
    	return $this;
    }
    
    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
    	return $this->content;
    }
           
    /**
     * Set user
     *
     * @param \DaVinci\TaxiBundle\Entity\User $user
     *
     * @return InternalMessage
     */
    public function setUser(User $user = null)
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
     * Set office
     *
     * @param string $office
     *
     * @return InternalMessage
     */
    public function setOffice($office)
    {
        $this->office = $office;

        return $this;
    }

    /**
     * Get office
     *
     * @return string
     */
    public function getOffice()
    {
        return $this->office;
    }
        
}
