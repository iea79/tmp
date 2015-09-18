<?php

namespace DaVinci\TaxiBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeoSubscriber implements EventSubscriberInterface
{
    
    /**
     * @var \DaVinci\TaxiBundle\Entity\Seo\ParamsRepository
     */
    private $seoParamsRepository;
    
    public function __construct($seoParamsRepository)
    {
        $this->seoParamsRepository = $seoParamsRepository;
    } 

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => array('onKernelController', 20)
        );
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controllers = $event->getController();
        
        if (
            $controllers[0] instanceof Controller
            && method_exists($controllers[0], 'setParams')
        ) {
            $params = $this->seoParamsRepository->findByActionName(
                $event->getRequest()->get('_route')
            );
            
            if (!is_null($params)) {
                $controllers[0]->setParams($params);
            }
                        
            $event->setController($controllers);
        }
    }

}
