<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationController extends Controller
{
    public function registerAction()
    {
        return $this->render('DaVinciTaxiBundle:Registration:register.html.twig');
    }
    
    public function manager_step2Action()
    {
        return $this->render('DaVinciTaxiBundle:Registration:manager_step2.html.twig');
    }
    
    public function taxidriver_step2Action()
    {
        return $this->render('DaVinciTaxiBundle:Registration:taxidriver_step2.html.twig');
    }
    
    public function company_step2Action()
    {
        return $this->render('DaVinciTaxiBundle:Registration:company_step2.html.twig');
    }

    public function company_step3Action()
    {
        return $this->render('DaVinciTaxiBundle:Registration:company_step3.html.twig');
    }
    
    public function independentdriver_step2Action()
    {
        return $this->render('DaVinciTaxiBundle:Registration:independentdriver_step2.html.twig');
    }
}
