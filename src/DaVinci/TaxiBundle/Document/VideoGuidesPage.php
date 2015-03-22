<?php

namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

use Symfony\Cmf\Bundle\CoreBundle\Translatable\TranslatableInterface;
use Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishTimePeriodInterface;
use Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishableInterface;
use Symfony\Cmf\Bundle\SeoBundle\SeoAwareInterface;
use Symfony\Cmf\Component\Routing\RouteReferrersReadInterface;


use Doctrine\Common\Collections\ArrayCollection;
/**
 * @PHPCR\Document(referenceable=true,translator="attribute", repositoryClass="VideoGuidesRepository")
 */
class VideoGuidesPage implements TranslatableInterface, 
        PublishTimePeriodInterface, 
        PublishableInterface, 
        SeoAwareInterface, 
        RouteReferrersReadInterface
{
    
    use ContentTrait;
    
    /**
     * @PHPCR\Id(strategy="repository")
     */
    protected $id;
    
   /**
    * @PHPCR\ReferenceOne(targetDocument="Application\Sonata\MediaBundle\PHPCR\Media", strategy="weak")
    */
    protected $youtubeLink;  
    
    /**
     * @PHPCR\Boolean()
     */
    protected $publishable = true;

    /**
     * @PHPCR\Date(nullable = true)
     */
    protected $publishStartDate;

    /**
     * @PHPCR\Date(nullable = true)
     */
    protected $publishEndDate;

    /**
     * @PHPCR\Boolean()
     */
    protected $forPassenger  = true;  
      
    /**
     * @PHPCR\Child
     */
    protected $seoMetadata;
    
    /**
     * @PHPCR\Referrers(
     *     referringDocument="Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Phpcr\Route",
     *     referencedBy="content"
     * )
     */
    public $routes;
    
    public function __construct()
    {
        $this->routes = new ArrayCollection();
    }
    
    function getSeoMetadata() {
        return $this->seoMetadata;
    }

    function setSeoMetadata($seoMetadata) {
        $this->seoMetadata = $seoMetadata;
    }
    
    function getForPassenger() {
        return $this->forPassenger;
    }

    function setForPassenger($forPassenger) {
        $this->forPassenger = $forPassenger;
    }
    function getId() {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setPublishable($publishable)
    {
        return $this->publishable = (bool) $publishable;
    }

    /**
     * {@inheritDoc}
     */
    public function isPublishable()
    {
        return $this->publishable;
    }

    /**
     * {@inheritDoc}
     */
    public function getPublishStartDate()
    {
        return $this->publishStartDate;
    }

    /**
     * {@inheritDoc}
     */
    public function setPublishStartDate(\DateTime $publishStartDate = null)
    {
        $this->publishStartDate = $publishStartDate;
    }

    /**
     * {@inheritDoc}
     */
    public function getPublishEndDate()
    {
        return $this->publishEndDate;
    }

    /**
     * {@inheritDoc}
     */
    public function setPublishEndDate(\DateTime $publishEndDate = null)
    {
        $this->publishEndDate = $publishEndDate;
    }

    /**
     * @return array of route objects that point to this content
     */
    public function getRoutes()
    {
        return $this->routes->toArray();
    }

    public function setYoutubeLink($youtubeLink) {
        $this->youtubeLink = $youtubeLink;
    }
    
    public function getYoutubeLink() {
        return $this->youtubeLink;
    }

}