<?php

namespace DaVinci\TaxiBundle\Entity\Seo;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity(repositoryClass="ParamsRepository")
 * @ORM\Table(name="seo_params")
 */
class Params 
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", name="action_name")
     */
    private $actionName;
    
    /**
     * @ORM\Column(type="string", name="action_path")
     */
    private $actionPath;
    
    /**
     * @ORM\Column(type="string", name="seo_title")
     */
    private $seoTitle;
    
    /**
     * @ORM\Column(type="string", name="seo_keywords")
     */
    private $seoKeywords;
    
    /**
     * @ORM\Column(type="string", name="seo_description")
     */
    private $seoDescription;
        

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set actionName
     *
     * @param string $actionName
     *
     * @return Params
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;

        return $this;
    }

    /**
     * Get actionName
     *
     * @return string
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * Set actionPath
     *
     * @param string $actionPath
     *
     * @return Params
     */
    public function setActionPath($actionPath)
    {
        $this->actionPath = $actionPath;

        return $this;
    }

    /**
     * Get actionPath
     *
     * @return string
     */
    public function getActionPath()
    {
        return $this->actionPath;
    }

    /**
     * Set seoTitle
     *
     * @param string $seoTitle
     *
     * @return Params
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    /**
     * Get seoTitle
     *
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * Set seoKeywords
     *
     * @param string $seoKeywords
     *
     * @return Params
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;

        return $this;
    }

    /**
     * Get seoKeywords
     *
     * @return string
     */
    public function getSeoKeywords()
    {
        return $this->seoKeywords;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     *
     * @return Params
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }
    
}

?>
