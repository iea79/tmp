<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function init()
    {
        // Please read http://symfony.com/doc/2.0/book/installation.html#configuration-and-setup
        bcscale(3);

        parent::init();
    }
    
    public function registerBundles()
    {
        $bundles = array(
            // SYMFONY STANDARD EDITION
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(xi),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),

            // DOCTRINE
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
           
            // KNP HELPER BUNDLES
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            
            // USER
            new FOS\UserBundle\FOSUserBundle(),
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            new DaVinci\UserBundle\DaVinciUserBundle(),
            
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            
            // NEWS
            //new Sonata\NewsBundle\SonataNewsBundle(),
            //new Application\Sonata\NewsBundle\ApplicationSonataNewsBundle(),
            
            new Sonata\ClassificationBundle\SonataClassificationBundle(),
            new Application\Sonata\ClassificationBundle\ApplicationSonataClassificationBundle(),
            
            // MEDIA
            new Sonata\MediaBundle\SonataMediaBundle(),
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
            
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new CoopTilleuls\Bundle\CKEditorSonataMediaBundle\CoopTilleulsCKEditorSonataMediaBundle(),
            
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Application\Sonata\AdminBundle\ApplicationSonataAdminBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),

            // API
            new FOS\RestBundle\FOSRestBundle(),
            new FOS\CommentBundle\FOSCommentBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new Lsw\ApiCallerBundle\LswApiCallerBundle(),

            // SONATA CORE & HELPER BUNDLES
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Sonata\jQueryBundle\SonatajQueryBundle(),
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\IntlBundle\SonataIntlBundle(),
            new Sonata\FormatterBundle\SonataFormatterBundle(),
            new Sonata\CacheBundle\SonataCacheBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\SeoBundle\SonataSeoBundle(),
            new Symfony\Cmf\Bundle\SeoBundle\CmfSeoBundle(),
            new \Burgov\Bundle\KeyValueFormBundle\BurgovKeyValueFormBundle(),
            new Liip\SearchBundle\LiipSearchBundle(),
            new Sonata\NotificationBundle\SonataNotificationBundle(),        
            new Sonata\TranslationBundle\SonataTranslationBundle(),
            new Application\Sonata\NotificationBundle\ApplicationSonataNotificationBundle(),
            new Sonata\CommentBundle\SonataCommentBundle(),
            new Application\Sonata\CommentBundle\ApplicationSonataCommentBundle(),
            
            // CMF Integration
            new Doctrine\Bundle\PHPCRBundle\DoctrinePHPCRBundle(),
            new Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle(),
            new Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),
            new Symfony\Cmf\Bundle\CreateBundle\CmfCreateBundle(),
            new Symfony\Cmf\Bundle\CoreBundle\CmfCoreBundle(),
            new Symfony\Cmf\Bundle\ContentBundle\CmfContentBundle(),
            new Symfony\Cmf\Bundle\BlockBundle\CmfBlockBundle(),
            new Symfony\Cmf\Bundle\TreeBrowserBundle\CmfTreeBrowserBundle(),
            new Sonata\DoctrinePHPCRAdminBundle\SonataDoctrinePHPCRAdminBundle(),
            new Symfony\Cmf\Bundle\SearchBundle\CmfSearchBundle(),
            new Symfony\Cmf\Bundle\MediaBundle\CmfMediaBundle(),
            new FM\ElfinderBundle\FMElfinderBundle(),

            //E-Commerce
            // new Sonata\CustomerBundle\SonataCustomerBundle(),
            // new Sonata\ProductBundle\SonataProductBundle(),
            // new Sonata\BasketBundle\SonataBasketBundle(),
            // new Sonata\OrderBundle\SonataOrderBundle(),
            // new Sonata\InvoiceBundle\SonataInvoiceBundle(),
            // new Sonata\MediaBundle\SonataMediaBundle(),
            // new Sonata\DeliveryBundle\SonataDeliveryBundle(),
            // new Sonata\PaymentBundle\SonataPaymentBundle(),
            // new Sonata\PriceBundle\SonataPriceBundle(),
            
            new Symfony\Cmf\Bundle\RoutingAutoBundle\CmfRoutingAutoBundle,
            
            // Disable this if you don't want the timeline in the admin
            new Spy\TimelineBundle\SpyTimelineBundle(),
            new Sonata\TimelineBundle\SonataTimelineBundle(),
            new Application\Sonata\TimelineBundle\ApplicationSonataTimelineBundle(),
            
            new Mopa\Bundle\BootstrapBundle\MopaBootstrapBundle(),
            
            new A2lix\I18nDoctrineBundle\A2lixI18nDoctrineBundle(),
            new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),
            
            
            new Craue\FormFlowBundle\CraueFormFlowBundle(),
            new DaVinci\TaxiBundle\DaVinciTaxiBundle(),
                        
            //looks like it gliches with symfony cmf                                                                                                                                                                                                                                                                                                                                                              
            //new JMS\I18nRoutingBundle\JMSI18nRoutingBundle(),
            

            // not required, but recommended for better extraction
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            // new JMS\TranslationBundle\JMSTranslationBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new JMS\Payment\CoreBundle\JMSPaymentCoreBundle(),
            new JMS\Payment\PaypalBundle\JMSPaymentPaypalBundle(),
            new Hearsay\RequireJSBundle\HearsayRequireJSBundle(),
            
            new Iphp\FileStoreBundle\IphpFileStoreBundle(),
            //thumbnail maker
            new Liip\ImagineBundle\LiipImagineBundle(),
            
            // language switcher
            new Lunetics\LocaleBundle\LuneticsLocaleBundle(),

            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Cocur\Slugify\Bridge\Symfony\CocurSlugifyBundle(),
                    
            // copy of whole bundle bcs of old dependencies
            // new Symfony\Cmf\Bundle\BlogBundle\CmfBlogBundle(),
            // new Application\Cmf\BlogBundle\ApplicationCmfBlogBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
