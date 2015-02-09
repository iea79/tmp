<?php

namespace DaVinci\TaxiBundle\Document;


use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Sonata\TranslationBundle\Model\Phpcr\TranslatableInterface as TranslatableInterface;

/**
 * @PHPCR\Document(translator="attribute", repositoryClass="ProfitRepository")
 */
class ProfitPage implements TranslatableInterface
{
    use ContentTrait;

    /**
     * @PHPCR\String(translated=true)
     */
    protected $title;
    
    /**
     * @PHPCR\Boolean()
     */
    private $driverTab;


     /**
     * @PHPCR\String(translated=true)
     */
    protected $block1;
    
     /**
     * @PHPCR\String(translated=true)
     */
    protected $block2Title;  
    
     /**
     * @PHPCR\String(translated=true)
     */
    protected $block2;      
    
    /**
    * @PHPCR\ReferenceOne(targetDocument="Application\Sonata\MediaBundle\PHPCR\Media", strategy="weak", cascade = "persist")
    */
    protected $youtubeLink;  
    
    public function getBlock1() {
        return $this->block1;
    }

    public function getBlock2Title() {
        return $this->block2Title;
    }

    public function getBlock2() {
        return $this->block2;
    }

    public function setBlock1($block1) {
        $this->block1 = $block1;
    }

    public function setBlock2Title($block2Title) {
        $this->block2Title = $block2Title;
    }

    public function setBlock2($block2) {
        $this->block2 = $block2;
    }

    public function setYoutubeLink($youtubeLink) {
        $this->youtubeLink = $youtubeLink;
    }
    
    public function getYoutubeLink() {
        return $this->youtubeLink;
    }

        /**
     * @param boolean tabTitle
     */
    public function setDriverTab($driverTab)
    {
        $this->driverTab = $driverTab;
    }
        
    /**
     * @return boolean
     */
    public function getDriverTab()
    {
        return $this->driverTab;
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    public function _toString()
    {
        return $this->title;
    }
}