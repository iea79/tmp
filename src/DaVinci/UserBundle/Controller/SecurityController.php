<?php

namespace DaVinci\UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use \FOS\UserBundle\Controller\SecurityController as BaseController;

class SecurityController extends BaseController 
{

    protected function renderLogin(array $data) 
    {
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return new RedirectResponse($this->container->get('router')->generate('da_vinci_taxi_homepage'));
        }

        $template = sprintf('FOSUserBundle:Security:login.html.%s', $this->container->getParameter('fos_user.template.engine'));

        return $this->container->get('templating')->renderResponse($template, $data);
    }

}
