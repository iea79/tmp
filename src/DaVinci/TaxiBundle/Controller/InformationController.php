<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InformationController extends Controller {

    public function profitAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        $driverTabs= $dm->getRepository('DaVinciTaxiBundle:ProfitPage')->getDriverProfitTab();
        $passengerTabs= $dm->getRepository('DaVinciTaxiBundle:ProfitPage')->getPassengerProfitTab();
        
        return $this->render('DaVinciTaxiBundle:Information:profit.html.twig',
                array(
                    'driver_tabs' => $driverTabs,
                    'passenger_tabs' => $passengerTabs
                ));
    }

    public function aboutAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        $allTabs= $dm->getRepository('DaVinciTaxiBundle:AboutPage')->findAll();
        
        return $this->render('DaVinciTaxiBundle:Information:about.html.twig',
                array(
                    'all_tabs' => $allTabs,
                ));
    }

    public function helpAction()
    {
        return $this->render('DaVinciTaxiBundle:Information:help.html.twig');
    }

    public function view_officesAction()
    {
        return $this->render('DaVinciTaxiBundle:Information:view_offices.html.twig');
    }

    public function videoAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        $allVideos= $dm->getRepository('DaVinciTaxiBundle:VideoGuidesPage')->findBy(array('publishable' => true));
            
        return $this->render('DaVinciTaxiBundle:Information:video.html.twig',
                array(
                    'videos' => $allVideos,
                ));
    }
    
    public function guideAction($contentDocument)
    {
         return $this->render('DaVinciTaxiBundle:Information:guide.html.twig',
                array(
                    'page' => $contentDocument,
                ));
    }
    
    public function guidesAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        $allGuides= $dm->getRepository('DaVinciTaxiBundle:GuidesPage')->findBy(array('publishable' => true));
            
        return $this->render('DaVinciTaxiBundle:Information:guides.html.twig',
                array(
                    'guides' => $allGuides,
                ));
    }

    public function one_helpAction()
    {
        return $this->render('DaVinciTaxiBundle:Information:one_help.html.twig');
    }

    public function FAQsAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        $allFaqs= $dm->getRepository('DaVinciTaxiBundle:FaqEntry')->findBy(array('published' => true));
            
        return $this->render('DaVinciTaxiBundle:Information:FAQs.html.twig',
                array(
                    'faqs' => $allFaqs,
                ));
    }

    public function notificationsAction()
    {
        return $this->render('DaVinciTaxiBundle:Notifications:notifications.html.twig');
    }

    public function new_ticketAction()
    {
        return $this->render('DaVinciTaxiBundle:Notifications:new_ticket.html.twig');
    }

    public function informationAction()
    {
        return $this->render('DaVinciTaxiBundle:Information:information.html.twig');
    }

    public function financial_officeAction()
    {
        return $this->render('DaVinciTaxiBundle:Finoffice:financial_office.html.twig');
    }
    
    public function storeAction()
    {
        return $this->render('DaVinciTaxiBundle:Store:store.html.twig');
    }
    
    public function sale_pageAction()
    {
        return $this->render('DaVinciTaxiBundle:Store:sale_page.html.twig');
    }

    public function letter_confirmAction()
    {
        return $this->render('DaVinciTaxiBundle:Email:letter_confirm.html.twig');
    }
    
}
