<?php
namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Id\RepositoryIdInterface;
use Doctrine\ODM\PHPCR\DocumentRepository as BaseDocumentRepository;

class FaqEntryRepository extends BaseDocumentRepository implements RepositoryIdInterface
{

	const PREFIX = 'faq-';

	/**
	 * Generate a document id
	 *
	 * @param object $document
	 * @return string
	 */
	public function generateId($document, $parent = null)
	{
		return '/cms'
			. '/' . $parent
			. '/' . \Cocur\Slugify\Slugify::create()->slugify($document->getQuestion());
	}
	
	public function findPublished()
	{
		return $this->findBy(
			array('published' => true),
			array('order' => 'asc')
		);
	}
    
    public function findForPassenger($trigger = true)
    {
    	return $this->findBy(
    		array('published' => true, 'forPassenger' => $trigger), 
    		array('order' => 'asc')
    	);
    }

    public function findFiltered($trigger = true, $category)
    {
        $filtered = array();
        
    	$faqs = $this->findForPassenger($trigger);
        
        foreach ($faqs as $key => $faq) {
            if ($faq->getCategory()->getId() == $category) {
                $filtered[$key] = $faq;
            }            
        }
        
        return $filtered;
    }
		
}