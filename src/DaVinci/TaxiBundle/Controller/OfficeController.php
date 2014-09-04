<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OfficeController extends Controller
{
    public function office_chooseAction()
    {
        return $this->render('DaVinciTaxiBundle:Offices:office_choose.html.twig');
    }
    
    public function office_companyAction()
    {
        return $this->render('DaVinciTaxiBundle:Offices:office_company.html.twig');
    }
       
    public function office_passengerAction()
    {
        return $this->render('DaVinciTaxiBundle:Offices:office_passenger.html.twig');
    }
        
    public function office_driverAction()
    {
        return $this->render('DaVinciTaxiBundle:Offices:office_driver.html.twig');
    }
    
    public function block_profileAction()
    {
        return $this->render('DaVinciTaxiBundle:Offices:block_profile.html.twig');
    }
    
    public function filter_tableAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:filter_table.html.twig');
    }
    
    public function order_tableAction()
    {
        return $this->render('DaVinciTaxiBundle:Offices:order_table.html.twig');
    }
    
    public function dispet_tableAction()
    {
        return $this->render('DaVinciTaxiBundle:Offices:dispet_table.html.twig');
    }

    public function register_companyAction()
    {
        return $this->render('DaVinciTaxiBundle:Offices:register_company.html.twig');
    }
    
    public function register_independent_driverAction()
    {
        return $this->render('DaVinciTaxiBundle:Offices:register_independent_driver.html.twig');
    }
    
    public function register_managerAction()
    {
        return $this->render('DaVinciTaxiBundle:Offices:register_manager.html.twig');
    }
    
    public function register_company_driverAction()
    {
        return $this->render('DaVinciTaxiBundle:Offices:register_company_driver.html.twig');
    }   
}
