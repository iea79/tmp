<?php

namespace Application\Cmf\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Application\Cmf\BlogBundle\Document\Blog as Blog;

class InformationController extends Controller {

    public function blogAction(Request $request)
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
    	$blog = $dm->getRepository('ApplicationCmfBlogBundle:Blog')->findAll()->first();
		
		if ($blog) {
			return $this->redirect(
				$this->generateUrl('blogs') . '/' . $blog->getSlug()
			);
		} else {
			return $this->render('DaVinciTaxiBundle:Information:info.html.twig', array(
				'reviews' => false,
				'social' => false,
				'isblog' => true
			));
		}
    }    
    
}
