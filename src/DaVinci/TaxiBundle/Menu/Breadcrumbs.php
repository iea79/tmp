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
        $menu = $this->factory->createItem('root')->setChildrenAttributes(array('class' => 'crunbs'));

        $menu->addChild('Home', array('route' => 'da_vinci_taxi_homepage'))->setExtra('translation_domain', 'DaVinciTaxiBundle');

        // create the menu according to the route
        switch ($request->get('_route')) {
            case 'fos_user_registration_register':
                $menu->addChild('Registration')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');
                // setCurrent is use to add a "current" css class
                ;
                break;
            case 'fos_user_security_login':
                $menu->addChild('Login')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');;
                break;
            case 'fos_user_resetting_request':
                $menu->addChild('Reset Password')->setCurrent(true)->setExtra('translation_domain', 'DaVinciTaxiBundle');;
                break;
        }

        return $menu;
    }

}
