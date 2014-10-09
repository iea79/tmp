<?php

namespace DaVinci\TaxiBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class Breadcrumbs {

    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory) {
        $this->factory = $factory;
    }

    public function createBreadcrumbMenu(Request $request) {
        $menu = $this->factory->createItem('root')->setChildrenAttributes(array('class' => 'breadcrumbs'));
        
        // create the menu according to the route
        switch ($request->get('_route')) {
            case 'register_independent_driver':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Register Indipendent driver')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                // setCurrent is use to add a "current" css class
                ;
                break;   
            case 'register_manager':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Taxi company manager')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                // setCurrent is use to add a "current" css class
                ;
                break;   
            case 'register_company_driver':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Register company driver')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                // setCurrent is use to add a "current" css class
                ;
                break;   
            case 'register_company':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Owner')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                // setCurrent is use to add a "current" css class
                ;
                break;            
            case 'fos_user_registration_register':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Registration')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                // setCurrent is use to add a "current" css class
                ;
                break;
            case 'fos_user_registration_check_email':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Registration', array('route' => 'fos_user_registration_register'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Check e-mail')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                ;
                break;
            case 'fos_user_security_login':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Login')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');;
                break;
            case 'fos_user_resetting_request':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Reset Password')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');;
                break;
            case 'office_choose':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Choose office')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');;
                break;
        }

        return $menu;
    }

}
