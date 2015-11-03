<?php
namespace DaVinci\TaxiBundle\Utils;

class Url
{
    private $container;
    
    public function __construct(\Symfony\Component\DependencyInjection\ContainerInterface $container) {
        $this->container = $container;
    }
    
    public function getPagesRoutes(){
        
        $router = $this->container->get('router');
        $collection = $router->getRouteCollection();

        $routes = array();

        foreach ($collection->all() as $name => $route) {
            if (false === $route->getOption('useAsInnerURL')) {
                continue;
            }

            if (($route->getOption('useAsInnerURL') && (true === $route->getOption('useAsInnerURL') || 'true' === $route->getOption('useAsInnerURL')))) {
//dump($name,$route->getOption('useAsInnerURL'));
                //$name = substr($name, strlen('uk__RG__')); // stupid hack to remove multilang url

                $routes[$name] = $router->generate($name);
            }
        }

        return $routes;
    }
}