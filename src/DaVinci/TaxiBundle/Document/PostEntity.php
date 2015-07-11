<?php

namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

use Symfony\Cmf\Bundle\CoreBundle\Translatable\TranslatableInterface;
use Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishTimePeriodInterface;
use Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishableInterface;

/**
 * @PHPCR\Document(referenceable=true, translator="attribute", repositoryClass="PostEntityRepository")
 */
class PostEntity implements PublishTimePeriodInterface, 
    PublishableInterface,
    TranslatableInterface
{
        
    use ContentTrait;
        
    /**
     * @PHPCR\Id(strategy="auto")
     */
    protected $id;
    
    /**
     * @PHPCR\String(translated=true)
     */
    protected $title;
    
    /**
     * @PHPCR\String(translated=true)
     */
    protected $preview;

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
    protected $isCommercial = false;  
    
    /**
     * @PHPCR\Long
     */
    protected $order;
    
    /**
     * @PHPCR\ReferenceOne(targetDocument="DaVinci\TaxiBundle\Document\BlogColumn", strategy="weak")
     */
    protected $blogColumn;
    
    /**
     * @PHPCR\String(translated=true)
     */
    protected $seoTitle;
    
    /**
     * @PHPCR\String(translated=true)
     */
    protected $seoKeywords;
    
    /**
     * @PHPCR\String(translated=true)
     */
    protected $seoDescription;
    
    /**
     * @PHPCR\ReferenceOne(targetDocument="Application\Sonata\MediaBundle\PHPCR\Media", strategy="weak")
     */
    protected $imagePreview;
    
    public function getId()
    {
    	return $this->id;
    }
    
    public function setId($id)
    {
    	$this->id = $id;
    	
    	return $this;
    }
    
    public function isCommercial() 
    {
        return $this->isCommercial;
    }

    public function setIsCommercial($isCommercial) 
    {
        $this->isCommercial = $isCommercial;
    }
    
    public function setTitle($title)
    {
    	$this->title = $title;
    	
    	return $this;
    }
    
    public function getTitle() 
    {
        return $this->title;
    }
    
    public function setPreview($preview)
    {
    	$this->preview = $preview;
    	
    	return $this;
    }
    
    public function getPreview()
    {
    	return $this->preview;
    }
    
    public function setBody($body)
    {
    	$this->body = $body;
    }

    public function getBody() 
    {
        return $this->body;
    }
    
    public function getBodyTrimmed() 
    {
        return mb_substr($this->body, 0, 150) . '...';
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
    
    public function setBlogColumn($blogColumn)
    {
    	$this->blogColumn = $blogColumn;
    	 
    	return $this;
    }
    
    public function getBlogColumn()
    {
    	return $this->blogColumn;
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
    
    public function setSeoTitle($seoTitle)
    {
    	$this->seoTitle = $seoTitle;
    	 
    	return $this;
    }
    
    public function getSeoTitle()
    {
    	return $this->seoTitle;
    }
    
    public function setSeoKeywords($seoKeywords)
    {
    	$this->seoKeywords = $seoKeywords;
    
    	return $this;
    }
    
    public function getSeoKeywords()
    {
    	return $this->seoKeywords;
    }
    
    public function setSeoDescription($seoDescription)
    {
    	$this->seoDescription = $seoDescription;
    
    	return $this;
    }
    
    public function getSeoDescription()
    {
    	return $this->seoDescription;
    }
    
    public function getImagePreview()
    {
    	return $this->imagePreview;
    }
    
    public function setImagePreview($imagePreview)
    {
    	$this->imagePreview = $imagePreview;
    
    	return $this;
    }
    
    public function __toString()
    {
    	return urlencode(serialize($this->id));
    }

}