<?php

namespace DaVinci\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class OfficeController extends Controller
{
    /**
    * @Route("/choose-office", name="fos_user_registration_confirmed")
    * @Method("GET")
    * @Security("has_role('ROLE_USER') or has_role('ROLE_TAXIDRIVER') or has_role('ROLE_COMPANYDRIVER') or has_role('ROLE_TAXIMANAGER') or has_role('ROLE_TAXICOMPANY')")
    */
    public function office_chooseAction()
    {
        return $this->render('DaVinciUserBundle:Offices:office_choose.html.twig');
    }
    
    /**
    * @Security("has_role('ROLE_TAXICOMPANY')")
    */
    public function office_companyAction()
    {
        return $this->render('DaVinciUserBundle:Offices:office_company.html.twig');
    }
    
    /**
    * @Security("has_role('ROLE_USER')")
    */
    public function office_passengerAction()
    {
        return $this->render('DaVinciUserBundle:Offices:office_passenger.html.twig');
    }
 
    /**
    * @Security("has_role('ROLE_TAXIDRIVER')")
    */
    public function office_driverAction()
    {
        return $this->render('DaVinciUserBundle:Offices:office_driver.html.twig');
    }
    
    public function block_profileAction()
    {
        return $this->render('DaVinciUserBundle:Offices:block_profile.html.twig');
    }
    
    public function filter_tableAction()
    {
        return $this->render('DaVinciUserBundle:Home:filter_table.html.twig');
    }
    
    public function order_tableAction()
    {
        return $this->render('DaVinciUserBundle:Offices:order_table.html.twig');
    }
    
    public function dispet_tableAction()
    {
        return $this->render('DaVinciUserBundle:Offices:dispet_table.html.twig');
    }

}
