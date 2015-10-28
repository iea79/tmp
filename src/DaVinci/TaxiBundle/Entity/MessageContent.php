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
	 * @ORM\Column(type="datetimetz", name="modify_date")
	 */
	private $modifyDate;
	
	/**
	 * @ORM\Column(type="string", length=255)
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set modifyDate
     *
     * @param \DateTime $modifyDate
     *
     * @return MessageContent
     */
    public function setModifyDate($modifyDate)
    {
        $this->modifyDate = $modifyDate;

        return $this;
    }

    /**
     * Get modifyDate
     *
     * @return \DateTime
     */
    public function getModifyDate()
    {
        return $this->modifyDate;
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

}

?>