<?php

namespace DaVinci\TaxiBundle\Services\Informer;

use DaVinci\TaxiBundle\Entity\User;

class MailerInformer extends AbstractInformer implements InformerInterface
{
	
	const MAIL_SUBJECT = 'Notification message';
	
	/**
	 * @var \Swift_Mailer
	 */
	protected $mailer;
    
    /**
	 * @var
	 */
	protected $templating;
    
    /**
     * @var string
     */
    protected $from;

    public function setMailer(\Swift_Mailer $mailer)
	{
		$this->mailer = $mailer;
	}
    
    public function setTemplating($templating)
    {
        $this->templating = $templating;
    }
    
    public function setFrom($from)
    {
        $this->from = $from;
    }
	
	public function notify(User $user, $literalCode)
	{
		$contentInfo = $this->prepareContent($literalCode);
		if (!$contentInfo->isMailNotification()) {
			return;
		}
		
		$message = \Swift_Message::newInstance()
			->setSubject(self::MAIL_SUBJECT)
			->setFrom($this->from)
            ->setTo($user->getEmail())
            ->setContentType("text/html")
			->setBody($this->generateMessageContent($contentInfo));
		
		$this->mailer->send($message);
	}
    
    private function generateMessageContent(MessageContent $contentInfo)
    {
        return $this->templating->render(
            'DaVinciTaxiBundle:Notifications:email.html.twig',
            array('contentInfo' => $contentInfo)
        );
    }
	
}

?>