<?php

namespace DaVinci\TaxiBundle\Entity\Payment;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="skrill_payment_method")
 */
class SkrillPaymentMethod extends PaymentMethod 
{
	
	/**
	 * @ORM\Column(type="string", length=100)
	 */
	protected $email;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 */
	protected $subject;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $note;

    /**
     * Set email
     *
     * @param string $email
     *
     * @return SkrillPaymentMethod
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return SkrillPaymentMethod
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
     * Set note
     *
     * @param string $note
     *
     * @return SkrillPaymentMethod
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
}

?>
