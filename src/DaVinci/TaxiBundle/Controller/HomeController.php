<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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

    public function profitAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:profit.html.twig');
    }

    public function profit_passengerAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:profit_passenger.html.twig');
    }

    public function profit_driverAction()
    {
        return $this->render('DaVinciTaxiBundle:Home:profit_driver.html.twig');
    }

}
