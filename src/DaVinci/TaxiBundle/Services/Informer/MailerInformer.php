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
		$contentInfo = $this->prepareContent($literalCode);
		if (!$contentInfo->isMailNotification()) {
			return;
		}
		
		$message = \Swift_Message::newInstance()
			->setSubject(self::MAIL_SUBJECT)
			->setTo($user->getEmail())
			->setBody($contentInfo->getContent());
		
		$this->mailer->send($message);
	}
	
}

?>