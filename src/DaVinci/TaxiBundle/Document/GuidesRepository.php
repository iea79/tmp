<?php
namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Id\RepositoryIdInterface;
use Doctrine\ODM\PHPCR\DocumentRepository as BaseDocumentRepository;
use Doctrine\Common\Collections\Criteria;

class GuidesRepository extends BaseDocumentRepository implements RepositoryIdInterface
{
	
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
				. '/' . \Cocur\Slugify\Slugify::create()->slugify($document->getTitle());
    }
    
    public function findPublished()
    {
    	return $this->findBy(
    		array('publishable' => true), 
    		array('order' => 'asc')
    	);
    }
    
}

?>