<?php
namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

trait ContentTrait
{
    
    /**
     * The language this document currently is in
     * @PHPCR\Locale
     */
    protected $locale;

    /**
     * @PHPCR\ParentDocument()
     */
    protected $parentDocument;

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
     * @return string|boolean The locale of this model or false if
     * translations are disabled in this project.
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string|boolean $locale The local for this model, or false if
     * translations are disabled in this project.
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
    
}