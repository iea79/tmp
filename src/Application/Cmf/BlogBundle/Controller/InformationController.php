<?php

namespace Application\Cmf\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\Cmf\BlogBundle\Document\Blog as Blog;
use Symfony\Component\HttpFoundation\Request;

class InformationController extends Controller {

    public function blogAction(Request $request)
    {
        $dm = $this->get('doctrine_phpcr')->getManager();

    	$blg = $dm->getRepository('ApplicationCmfBlogBundle:Blog')->findAll()->first();
        if($blg)
        {
            $url = $this->generateUrl('blogs').'/'.$blg->getSlug();
            return $this->redirect($url);
        }
        else
        {
            return $this->render('DaVinciTaxiBundle:Information:info.html.twig',
                array(
                    'reviews' => false,
                    'social' => false,
                    'isblog' => true
                ));
        }

    }    
    
}