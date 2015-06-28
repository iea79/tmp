<?php

namespace DaVinci\TaxiBundle\Document;


use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Sonata\TranslationBundle\Model\Phpcr\TranslatableInterface as TranslatableInterface;

use Doctrine\Common\Collections\ArrayCollection;
use Application\Sonata\CommentBundle\PHPCR\FakeComment as FakeComment;

/**
 * @PHPCR\Document(translator="attribute", repositoryClass="AboutRepository")
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
    private $textToLeft;


     /**
     * @PHPCR\String(translated=true)
     */
    protected $textBlock;
    
     /**
     * @PHPCR\ReferenceMany(targetDocument="Application\Sonata\CommentBundle\PHPCR\FakeComment", strategy="hard", cascade = "persist")
     */
    protected $comments;  
    
     /**
     * @PHPCR\String(translated=true)
     */
    protected $buttonText;      
    
    /**
     * @PHPCR\String()
     */
    protected $buttonLink;     
    
    /**
    * @PHPCR\ReferenceOne(targetDocument="Application\Sonata\MediaBundle\PHPCR\Media", strategy="weak")
    */
    protected $youtubeLink;  
    
    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getComments() {
        return $this->comments;
    }
       
    public function removeComment(FakeComment $comment)
    {
        $this->comments->removeElement($comment);
    }
    
    public function addComment(FakeComment $comment)
    {
        if ($this->comments != NULL && !$this->comments->contains($comment)) {
            $this->comments->add($comment);
        }

        return $this;
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

    public function getButtonLink() {
        return $this->buttonLink;
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

    public function setButtonLink($buttonLink) {
        $this->buttonLink = $buttonLink;
    }

    public function setYoutubeLink($youtubeLink) {
        $this->youtubeLink = $youtubeLink;
    }
        
    public function _toString()
    {
        return $this->title;
    }
}