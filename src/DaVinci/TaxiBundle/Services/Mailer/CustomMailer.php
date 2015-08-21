<?php

namespace DaVinci\TaxiBundle\Services\Mailer;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\TwigSwiftMailer as BaseMailer;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CustomMailer extends BaseMailer
{
    
    protected $imageDir;

    public function __construct(
        \Swift_Mailer $mailer,
        UrlGeneratorInterface $router,
        \Twig_Environment $twig,
        array $parameters,
        $imageDir
    ) {
        $this->imageDir = $imageDir;
        
        parent::__construct($mailer, $router, $twig, $parameters);
    }

    /**
     * @param string $templateName
     * @param array  $context
     * @param string $fromEmail
     * @param string $toEmail
     */
    protected function sendMessage($templateName, $context, $fromEmail, $toEmail)
    {
        $message = \Swift_Message::newInstance();
        
        $context['logoImage'] = $message->embed(
            \Swift_Image::fromPath($this->imageDir . ' /logo.png')
        );
        $context['letterbgImage'] = $message->embed(
            \Swift_Image::fromPath($this->imageDir . ' /letterbg.png')
        );

        $context = $this->twig->mergeGlobals($context);
        $template = $this->twig->loadTemplate($templateName);
        
        $subject = $template->renderBlock('subject', $context);
        $htmlBody = $template->render($context);
        
        $textBody = '';

        $message
            ->setSubject($subject)
            ->setFrom($fromEmail)
            ->setTo($toEmail);

        if (!empty($htmlBody)) {
            $message
                ->setBody($htmlBody, 'text/html')
                ->addPart($textBody, 'text/plain');
        } else {
            $message->setBody($textBody);
        }

        $this->mailer->send($message);
    }
}
