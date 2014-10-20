<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:index.html.twig');
    }
    
    public function main_driverAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:main_driver.html.twig');
    }
    
    public function order_step_1Action()
    {
        return $this->render('DaVinciTaxiBundle:Home:order_step_1.html.twig');
    }
    
    public function order_step_2Action()
    {
        return $this->render('DaVinciTaxiBundle:Home:order_step_2.html.twig');
    }
    
    public function order_step_3Action()
    {
        return $this->render('DaVinciTaxiBundle:Home:order_step_3.html.twig');
    }

    public function order_step_4Action()
    {
        return $this->render('DaVinciTaxiBundle:Home:order_step_4.html.twig');
    }

}
