<?php
namespace DaVinci\TaxiBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function bottomMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Info', array('route' => 'info'));
        $menu->addChild('Privacy Policy', array('route' => 'privacy_policy'));
        
        return $menu;
    }
        
    public function socialMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root')->setChildrenAttributes(array('class' => 'social'));
                          
        $menu->addChild('youtube', array('uri' => 'http://youtube.com/taximyprice'))->setLinkAttribute('class','youtube');
        $menu->addChild('twitter', array('uri' => 'http://twitter.com/taximyprice'))->setLinkAttribute('class','twitter');
        $menu->addChild('facebook', array('uri' => 'http://fb.com/taximyprice'))->setLinkAttribute('class','facebook');
        $menu->addChild('google+', array('uri' => 'http://plus.google.com/taximyprice'))->setLinkAttribute('class','google');
        $menu->addChild('linkedin', array('uri' => 'http://linkedin.com/taximyprice'))->setLinkAttribute('class','linkedin');;
        
        return $menu;
    }
}