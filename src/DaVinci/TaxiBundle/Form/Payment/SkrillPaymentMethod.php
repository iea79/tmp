<?php

namespace DaVinci\TaxiBundle\Form\Payment;

class SkrillPaymentMethod extends PaymentMethod 
{
	
	/**
	 * @var string
	 */
	protected $email;
	
	/**
	 * @var string
	 */
	protected $subject;
	
	/**
	 * @var string
	 */
	protected $note;
	

	public function setEmail($email)
	{
		$this->email = $email;
	
		return $this;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
		
	public function setSubject($subject)
	{
		$this->subject = $subject;
	
		return $this;
	}
	
	public function getSubject()
	{
		return $this->subject;
	}
	
	public function setNote($note)
	{
		$this->note = $note;
	
		return $this;
	}
	
	public function getNote()
	{
		return $this->note;
	}
		
}

?>