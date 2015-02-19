<?php

namespace Application\Sonata\CommentBundle\PHPCR;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * @PHPCR\Document(referenceable=true)
 */
class FakeComment  {

    /**
     * @PHPCR\Id(strategy="auto")
     */
    protected $id;
    
    /**
     * @PHPCR\String
     */
    protected $authorName;

    /**
     * @PHPCR\String
     */
    protected $message;
    
    /**
     * @PHPCR\Date
     */
    protected $date;
    
    /**
     * @PHPCR\Int
     */
    protected $value;
    
    /**
     * @PHPCR\ParentDocument()
     */
    protected $parentDocument;

    public static function getValueList()
    {
        return array(
            1 => '1 star',
            2 => '2 stars',
            3 => '3 stars',
            4 => '4 stars',
            5 => '5 stars',
        );
    }
    
    /**
     * Get the parent document of this document.
     *
     * @return object|null
     */
    public function getParentDocument()
    {
        return $this->parentDocument;
    }

    /**
     * Set the parent document for this document.
     *
     * @param object $parent
     *
     * @return $this
     */
    public function setParentDocument($parent)
    {
        $this->parentDocument = $parent;
    }
    
    /**
     * Get id
     * @return integer $id
     */
    public function getId() {
        return $this->id;
    }

    function getValue() {
        return $this->value;
    }

    function setValue($value) {
        $this->value = $value;
    }

    function getAuthorName() {
        return $this->authorName;
    }

    function getMessage() {
        return $this->message;
    }
    
    function getMessageTrimmed(){
        return submstr($this->message,0,100);
    }

    function getDate() {
        return $this->date;
    }

    function setAuthorName($authorName) {
        $this->authorName = $authorName;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setDate($date) {
        $this->date = $date;
    }

}
