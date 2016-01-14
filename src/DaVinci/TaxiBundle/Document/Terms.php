<?php

namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Sonata\TranslationBundle\Model\Phpcr\TranslatableInterface as TranslatableInterface;

/**
 * @PHPCR\Document(referenceable=true, translator="attribute")
 */
class Terms implements translatableinterface
{
    
    use ContentTrait;
    
    /**
     * @PHPCR\Id(strategy="auto")
     */
    protected $id;
    
    public function getId() 
    {
        return $this->id;
    }
    
    public function setId($id) 
    {
        $this->id = $id;
    }

    /**
     * @PHPCR\String(translated=true)
     */
    protected $title;  

    public function getTitle() 
    {
        return $this->title;
    }

    public function setTitle($title) 
    {
        $this->title = $title;
    }

    /**
     * @PHPCR\String(translated=true)
     */
    protected $textBlock;

    public function getTextBlock() {
        return $this->textBlock;
    }

    public function setTextBlock($textBlock) {
        $this->textBlock = $textBlock;
    }

    public function __toString()
    {
        return urlencode(serialize($this->id));
    }
    
}