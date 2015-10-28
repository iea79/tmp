<?php

namespace DaVinci\TaxiBundle\DataFixtures\PHPCR;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Cmf\Bundle\SimpleCmsBundle\Doctrine\Phpcr\Page;
use Symfony\Component\DependencyInjection\ContainerAware;

use Doctrine\ODM\PHPCR\DocumentManager as DocumentManager;
use PHPCR\Util\NodeHelper;
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Phpcr\RedirectRoute;
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Phpcr\Route;

class LoadPageData extends ContainerAware implements FixtureInterface, OrderedFixtureInterface 
{

	// refers to the order in which the class' load function is called
	// (lower return values are called first)
    public function getOrder() {
        return 50;
    }

    public function load(ObjectManager $manager) {
        if (!$manager instanceof DocumentManager) {
            $class = get_class($documentManager);
            throw new \RuntimeException("Fixture requires a PHPCR ODM DocumentManager instance, instance of '{$class}' given.");
        }
        
        $basepath = $this->container->getParameter('cmf_simple_cms.persistence.phpcr.basepath');
        
        $session = $manager->getPhpcrSession();
        if ($session->itemExists($basepath)) {
            $session->removeItem($basepath);
        }
        
        NodeHelper::createPath($session, $basepath);
        
        $root = $manager->find(null, $basepath);
        $root->setTitle('simple cms root (hidden by the home route in the sandbox)');
        
        $this->createPage(
        	$manager, $root, 'some_about', 'About us', 'Some information about us', 'The about us page with some content'
		);
        $this->createPage(
        	$manager, $root, 'contact', 'Contact', 'A contact page', 'Please send an email to cmf-devs@groups.google.com'
		);
                
        // set extras
      	/*  
       	$extras = array(
            'subtext' => 'Add CMS functionality to applications built with the Symfony2 PHP framework.',
            'headline-icon' => 'exclamation.png',
        );

        $page->setExtras($extras);
        */
        
        // add the Page to PHPCR
        $manager->flush(); 
    }
    
    /**
     * @return Page instance with the specified information
     */
    protected function createPage(DocumentManager $manager, $parent, $name, $label, $title, $body)
    {
        // $page = new Page(array('add_locale_pattern' => true));
    	$page = new Page();
        $page->setPosition($parent, $name);
        $page->setLabel($label);
        $page->setTitle($title);
        $page->setBody($body);
        
        $manager->persist($page);
        // $manager->bindTranslation($page, 'en');
        
        return $page;
    }
}
