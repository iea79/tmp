<?php

namespace Application\Cmf\BlogBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Sonata\TranslationBundle\Model\Phpcr\TranslatableInterface as TranslatableInterface;


use Symfony\Cmf\Bundle\BlogBundle\Doctrine\Phpcr\Post as BasePost;

/**
 * @PHPCR\Document(translator="attribute")
 */
class Post extends BasePost implements TranslatableInterface
{
    /**
     * @PHPCR\String(translated=true)
     */
    protected $title;

    /**
     * @PHPCR\String(translated=true)
     */
    protected $bodyPreview;

    /**
     * @PHPCR\String(translated=true)
     */
    protected $body;
    
    /**
     * The language this document currently is in
     * @PHPCR\Locale
     */
    protected $locale;
    
    /**
     * @PHPCR\ReferenceOne(targetDocument="Application\Sonata\MediaBundle\PHPCR\Media", cascade={"persist"})
     */
    protected $media;
    
    /**
     * @return string|boolean The locale of this model or false if
     *                        translations are disabled in this project.
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string|boolean $locale The local for this model, or false if
     *                               translations are disabled in this project.
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
    
    /**
     * @param Sonata\MediaBundle\Model\MediaInterface $media
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }

    /**
     * @return MediaInterface
     */
    public function getMedia()
    {
        return $this->media;
    }
    
    public function __toString()
    {
        
        $slug = \Cocur\Slugify\Slugify::create()->slugify($this->title);
        if (empty($slug)) {
        	$slug = date('Y-m-d-i-s');
        }
        
        return $slug;
    }
}
