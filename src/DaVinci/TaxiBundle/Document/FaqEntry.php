<?php

namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

use Symfony\Cmf\Bundle\CoreBundle\Translatable\TranslatableInterface;
use Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishTimePeriodInterface;
use Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishableInterface;
use Symfony\Cmf\Bundle\SeoBundle\SeoAwareInterface;
use Symfony\Cmf\Component\Routing\RouteReferrersReadInterface;
/**
 * @PHPCR\Document(referenceable=true, translator="attribute", repositoryClass="FaqEntryRepository")
 */
class FaqEntry implements translatableinterface
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
    protected $forPassenger = true;  
    
    /**
     * @PHPCR\Boolean()
     */
    protected $published = true;

    /**
     * @PHPCR\Long
     */
    protected $order;
    
    /**
     * @PHPCR\ReferenceOne(targetDocument="DaVinci\TaxiBundle\Document\Category", strategy="weak")
     */
    protected $category;
    
    public function getId() 
    {
        return $this->id;
    }
    
    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getQuestion() 
    {
        return $this->question;
    }

    public function getAnswer() 
    {
        return $this->answer;
    }

    public function getPublished() 
    {
        return $this->published;
    }
    
    public function setQuestion($question) 
    {
        $this->question = $question;
    }

    public function setAnswer($answer) 
    {
        $this->answer = $answer;
    }

    public function setPublished($published) 
    {
        $this->published = $published;
    }

    public function getForPassenger() 
    {
        return $this->forPassenger;
    }

    public function setForPassenger($forPassenger) 
    {
        $this->forPassenger = $forPassenger;
    }
    
    public function setOrder($order)
    {
    	$this->order = $order;
    	
    	return $this;
    }
    
    public function getOrder()
    {
    	return $this->order;
    }
    
    public function setCategory($category)
    {
    	$this->category = $category;
    	
    	return $this;
    }
    
    public function getCategory()
    {
    	return $this->category;
    }
    
    public function __toString()
    {
    	return urlencode(serialize($this->id));
    }
    
}