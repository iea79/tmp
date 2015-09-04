<?php

namespace DaVinci\TaxiBundle\Services\Informer;

use DaVinci\TaxiBundle\Entity\User;
use DaVinci\TaxiBundle\Entity\MessageContent;

class MailerInformer extends AbstractInformer
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
    
    /**
     * @var string
     */
    protected $imageDir;

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
    
    public function setImageDir($imageDir)
    {
        $this->imageDir = $imageDir;
    }    
	
	protected function process(User $user, MessageContent $contentInfo)
	{
		if (!$contentInfo->isMailNotification()) {
			return;
		}
		
        $context = array(
            'subject' => $contentInfo->getSubject(),
            'content' => $contentInfo->getContent(),
            'user' => $user,
            'logoImage' => \Swift_Image::fromPath($this->imageDir . '/logo.png')
        );
        $template = $this->templating->loadTemplate(
            'DaVinciTaxiBundle:Email:general.html.twig'
        );
        
		$message = \Swift_Message::newInstance()
			->setSubject($template->renderBlock('subject', $context))
			->setFrom($this->from)
            ->setTo($user->getEmail())
            ->setContentType("text/html")
			->setBody($template->renderBlock('body_html', $context));
		
		$this->mailer->send($message);
	}
    	
}

?>