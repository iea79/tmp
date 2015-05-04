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
	 * @ORM\Column(type="string", name="literal_code", length=255)
	 */
	private $literalCode;
	
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
}
