<?php

namespace DaVinci\TaxiBundle\Services\Informer;

use DaVinci\TaxiBundle\Entity\User;

class MailerInformer extends AbstractInformer implements InformerInterface
{
	
	const MAIL_SUBJECT = 'Notification e-mail';
	
	/**
	 * @var \Swift_Mailer
	 */
	protected $mailer;
	
	public function setMailer(\Swift_Mailer $mailer)
	{
		$this->mailer = $mailer;
	}
	
	public function notify(\DaVinci\TaxiBundle\Entity\User $user, $literalCode)
	{
		$message = $this->mailer
			->setSubject(self::MAIL_SUBJECT)
			->setTo($user->getEmail())
			->setBody($this->prepareContent($literalCode));
		
		$this->mailer->send($message);
	}
	
}

?>