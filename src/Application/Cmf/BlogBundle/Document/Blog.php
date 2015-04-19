<?php

namespace Application\Cmf\BlogBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Sonata\TranslationBundle\Model\Phpcr\TranslatableInterface as TranslatableInterface;
use Symfony\Cmf\Bundle\BlogBundle\Doctrine\Phpcr\Blog as BaseBlog;


use Doctrine\Common\Collections\ArrayCollection;

/**
 * @PHPCR\Document(translator="attribute")
 */
class Blog extends BaseBlog implements TranslatableInterface
{
    
    /**
     * @PHPCR\String(translated=true)
     */
    protected $name;

    /**
     * @PHPCR\String(translated=true)
     */
    protected $description;
    
    /** 
     * @PHPCR\Children 
     */
    protected $topPosts;
    
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->topPosts = new ArrayCollection();
    }
    
    function getTopPosts()
    {
        return $this->topPosts;
    }

    function setTopPosts(ArrayCollection $topPosts)
    {
        $this->topPosts = $topPosts;
    }

    /**
     * Add top post.
     *
     * @param Post $post
     *
     * @return Blog
     */
    public function addTopPost(Post $post)
    {
 
        if (!$this->topPosts->contains($post)) {
            $this->topPosts->add($post);
        }

        return $this;
    }

    /**
     * Remove top post.
     *
     * @param Post $post
     *
     * @return Blog
     */
    public function removeTopPost(Post $post)
    {
        if ($this->topPosts->contains($post)) {
            $this->topPosts->remove($post);
        }

        return $this;
    }
    
    /**
     * The language this document currently is in
     * @PHPCR\Locale
     */
    private $locale;
 
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
     * {@inheritDoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        $this->slug = \Cocur\Slugify\Slugify::create()->slugify($name);

        return $this;
    }
    
    public function __toString()
    {
        return \Cocur\Slugify\Slugify::create()->slugify($this->name);
    }
    
}
