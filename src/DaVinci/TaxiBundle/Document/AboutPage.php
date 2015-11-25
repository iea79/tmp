<?php

namespace DaVinci\TaxiBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Sonata\TranslationBundle\Model\Phpcr\TranslatableInterface as TranslatableInterface;
use Application\Sonata\CommentBundle\PHPCR\FakeComment as FakeComment;


/**
 * @PHPCR\Document(referenceable=true, translator="attribute", repositoryClass="AboutRepository")
 */

class AboutPage implements TranslatableInterface
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
     * @PHPCR\Boolean()
     */
    protected $textToLeft;

    /**
     * @PHPCR\String(translated=true)
     */
    protected $textBlock;

    /**
     * @PHPCR\String(translated=true)
     */
    protected $buttonText;      

    /**
     * @PHPCR\ReferenceOne(targetDocument="Application\Sonata\MediaBundle\PHPCR\Media", strategy="weak")
     */
    protected $youtubeLink;
    
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getTextToLeft() {
        return $this->textToLeft;
    }

    public function getTextBlock() {
        return $this->textBlock;
    }

    public function getButtonText() {
        return $this->buttonText;
    }

    public function getYoutubeLink() {
        return $this->youtubeLink;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setTextToLeft($textToLeft) {
        $this->textToLeft = $textToLeft;
    }

    public function setTextBlock($textBlock) {
        $this->textBlock = $textBlock;
    }

    public function setButtonText($buttonText) {
        $this->buttonText = $buttonText;
    }

    public function setYoutubeLink($youtubeLink) {
        $this->youtubeLink = $youtubeLink;
    }

    public function _toString()
    {
        return $this->title;
    }
}