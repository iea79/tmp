<?php

namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Sonata\TranslationBundle\Model\Phpcr\TranslatableInterface as TranslatableInterface;

/**
 * @PHPCR\Document(translator="attribute")
 */
class FaqEntry implements TranslatableInterface
{
    use ContentTrait;
    
    /**
     * @PHPCR\Id(strategy="auto")
     */
    protected $id;
    
    /**
     * @PHPCR\String(translated=true)
     */
    protected $question;      
    
    /**
     * @PHPCR\String(translated=true)
     */
    protected $answer;      
    
    /**
     * @PHPCR\Boolean()
     */
    protected $forPassenger  = true;  
    
    /**
     * @PHPCR\Boolean()
     */
    protected $published = true;  
    
    function getId() {
        return $this->id;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function getQuestion() {
        return $this->question;
    }

    function getAnswer() {
        return $this->answer;
    }

    function getPublished() {
        return $this->published;
    }

    function setQuestion($question) {
        $this->question = $question;
    }

    function setAnswer($answer) {
        $this->answer = $answer;
    }

    function setPublished($published) {
        $this->published = $published;
    }

    function getForPassenger() {
        return $this->forPassenger;
    }

    function setForPassenger($forPassenger) {
        $this->forPassenger = $forPassenger;
    }
    
}