<?php

namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Sonata\TranslationBundle\Model\Phpcr\TranslatableInterface as TranslatableInterface;

/**
 * @PHPCR\Document(referenceable=true, translator="attribute", repositoryClass="BlogColumnRepository")
 */
class BlogColumn implements TranslatableInterface
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
    protected $description;
    
    /**
     * @PHPCR\ReferenceOne(targetDocument="Application\Sonata\MediaBundle\PHPCR\Media", strategy="weak")
     */
    protected $imagePreview;
    
    /**
     * @PHPCR\Boolean()
     */
    protected $isDefault = false;
    
    /**
     * @PHPCR\Boolean()
     */
    protected $isActive = true;
    
    /**
     * @PHPCR\Referrers(referringDocument="DaVinci\TaxiBundle\Document\PostEntity", referencedBy="blogColumn")
     */
    protected $referrers;
    
    /**
     * @PHPCR\Long
     */
    protected $order;
    
    public function getId() 
    {
        return $this->id;
    }
    
    public function setId($id) 
    {
        $this->id = $id;
        
        return $this;
    }

    public function getTitle() 
    {
        return $this->title;
    }

    public function setTitle($title) 
    {
        $this->title = $title;
        
        return $this;
    }
    
    public function getDescription()
    {
    	return $this->description;
    }
    
    public function setDescription($description)
    {
    	$this->description = $description;
    
    	return $this;
    }
    
    public function isDefault()
    {
    	return $this->isDefault;
    }
    
    public function setIsDefault($isDefault)
    {
    	$this->isDefault = $isDefault;
    	
    	return $this;
    }
    
    public function isActive()
    {
    	return $this->isActive;
    }
    
    public function setIsActive($isActive)
    {
    	$this->isActive = $isActive;
    	
    	return $this;
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
    
    public function setOrder($order)
    {
    	$this->order = $order;
    	 
    	return $this;
    }
    
    public function getOrder()
    {
    	return $this->order;
    }
    
}

?>