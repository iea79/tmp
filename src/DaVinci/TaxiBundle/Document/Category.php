<?php

namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Sonata\TranslationBundle\Model\Phpcr\TranslatableInterface as TranslatableInterface;

/**
 * @PHPCR\Document(referenceable=true, translator="attribute")
 */
class Category implements TranslatableInterface
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
        
    public function __toString()
    {
    	return urlencode(serialize($this->id));
    }
    
}