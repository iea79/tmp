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
        
        $route = $request->get('_route');
        
        // create the menu according to the route
        switch ($route) {
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
                $menu->addChild('Login')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                break;
            case 'fos_user_resetting_request':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Reset Password')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                break;
            case 'office_choose':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Choose office')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                break;
            case 'office_passenger':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Office-Passenger')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                break;
            case 'office_driver':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Office-Driver')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                break;
            case 'about':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('About')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                break;
            case 'help':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Help')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                break;
             case 'profit':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Profit')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                break;
            case 'notifications':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Notifications')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                break;
            
            case 'guides':
                $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
                $menu->addChild('Guides')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                // setCurrent is use to add a "current" css class
                ;
                break;   
        }


        if (0 === strpos($route, '/cms/routes/guides/')) {
            $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
            $menu->addChild('Guides', array('route' => 'guides'))->setExtra('translation_domain', 'DaVinciTaxiBundle');
            
            $title = $request->attributes->get('contentDocument')->getTitle();
            
            $menu->addChild($title)->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
        }
            
        return $menu;
    }

}
