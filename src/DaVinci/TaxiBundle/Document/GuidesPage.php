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
 * @PHPCR\Document(referenceable=true, translator="attribute", repositoryClass="GuidesRepository")
 */
class GuidesPage implements TranslatableInterface, 
	PublishTimePeriodInterface, 
    PublishableInterface
{

    use ContentTrait;
        
    /**
     * @PHPCR\Id(strategy="repository")
     */
    protected $id;
    
    /**
     * @PHPCR\String(translated=true)
     */
    protected $title;

    /**
     * @PHPCR\String(translated=true)
     */
    protected $body;
    
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
    protected $forPassenger = true;  
    
    /**
     * @PHPCR\Long
     */
    protected $order;
    
    /**
     * @PHPCR\ReferenceOne(targetDocument="DaVinci\TaxiBundle\Document\Category", strategy="weak")
     */
    protected $category;
    
	public function getId()
    {
    	return $this->id;
    }
    
    public function getForPassenger() 
    {
        return $this->forPassenger;
    }

    public function setForPassenger($forPassenger) 
    {
        $this->forPassenger = $forPassenger;
    }
    
    public function getTitle() 
    {
        return $this->title;
    }

    public function getBody() 
    {
        return $this->body;
    }
    
    public function getBodyTrimmed() 
    {
        return mb_substr($this->body, 0, 150) . '...';
    }
    
    public function setTitle($title) 
    {
        $this->title = $title;
    }

    public function setBody($body) 
    {
        $this->body = $body;
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
    
    public function setCategory($category)
    {
    	$this->category = $category;
    	 
    	return $this;
    }
    
    public function getCategory()
    {
    	return $this->category;
    }
    
    public function setOrder($order)
    {
    	$this->order = $order;
    	 
    	return $this;
    }
    
    public function getOrder()
    {
    	return $this->order;
    }
    
    public function __toString()
    {
    	return urlencode(serialize($this->id));
    }

}