<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity(repositoryClass="MessageContentRepository")
 * @ORM\Table(name="message_content")
 */
class MessageContent 
{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
		
    /**
	 * @ORM\Column(type="string", length=255)
	 */
	private $subject;
    
	/**
	 * @ORM\Column(type="text")
	 */
	private $content;
	
	/**
	 * @ORM\Column(type="string", columnDefinition="ENUM('approve.request', 'decline-driver.request', 'cancel.request')", name="literal_code", length=100)
	 */
	private $literalCode;
	
	/**
	 * @ORM\Column(type="boolean", name="mail_notification")
	 */
	private $mailNotification = false;
	
	/**
	 * @ORM\Column(type="boolean", name="internal_notification")
	 */
	private $internalNotification = false;
    
    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('user', 'taxi-independent-driver', 'taxi-company-driver')", length=50)
     */
    private $recipient;
	
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
     * @return MessageContent
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

    /**
     * Set mailNotification
     *
     * @param boolean $mailNotification
     *
     * @return MessageContent
     */
    public function setMailNotification($mailNotification)
    {
        $this->mailNotification = $mailNotification;

        return $this;
    }

    /**
     * Get mailNotification
     *
     * @return boolean
     */
    public function isMailNotification()
    {
        return $this->mailNotification;
    }
    
    /**
     * Get mailNotification
     *
     * @return boolean
     */
    public function getMailNotification()
    {
        return $this->mailNotification;
    }

    /**
     * Set internalNotification
     *
     * @param boolean $internalNotification
     *
     * @return MessageContent
     */
    public function setInternalNotification($internalNotification)
    {
        $this->internalNotification = $internalNotification;

        return $this;
    }

    /**
     * Get internalNotification
     *
     * @return boolean
     */
    public function isInternalNotification()
    {
        return $this->internalNotification;
    }

    /**
     * Get internalNotification
     *
     * @return boolean
     */
    public function getInternalNotification()
    {
        return $this->internalNotification;
    }
    

    /**
     * Set recipient
     *
     * @param string $recipient
     *
     * @return MessageContent
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get recipient
     *
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }
}
