<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CabinetCompanyController extends Controller
{
    public function cabinet_companyAction()
    {
        return $this->render('DaVinciTaxiBundle:CabinetCompany:cabinet_company.html.twig');
    }
    
    public function block_profileAction()
    {
        return $this->render('DaVinciTaxiBundle:CabinetCompany:block_profile.html.twig');
    }
    
    public function filter_tableAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:filter_table.html.twig');
    }
    
    public function order_tableAction()
    {
        return $this->render('DaVinciTaxiBundle:CabinetCompany:order_table.html.twig');
    }
    
    public function dispet_tableAction()
    {
        return $this->render('DaVinciTaxiBundle:CabinetCompany:dispet_table.html.twig');
    }


}
