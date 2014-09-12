<?php

namespace DaVinci\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OfficeController extends Controller
{
    public function office_chooseAction()
    {
        return $this->render('DaVinciUserBundle:Offices:office_choose.html.twig');
    }
    
    public function office_companyAction()
    {
        return $this->render('DaVinciUserBundle:Offices:office_company.html.twig');
    }
       
    public function office_passengerAction()
    {
        return $this->render('DaVinciUserBundle:Offices:office_passenger.html.twig');
    }
        
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
