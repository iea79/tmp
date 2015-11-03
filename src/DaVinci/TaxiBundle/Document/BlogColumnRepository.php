<?php
namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Id\RepositoryIdInterface;
use Doctrine\ODM\PHPCR\DocumentRepository as BaseDocumentRepository;

class BlogColumnRepository extends BaseDocumentRepository implements RepositoryIdInterface
{
	
	const DEFAULT_LIMIT = 1;
	
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
    
    public function findDefault()
    {
    	return $this->findOneBy(
    		array('isDefault' => true)
    	);
    }
    
    public function findActive()
    {
    	return $this->findBy(
    		array('isActive' => true),
    		array('order' => 'asc')
    	);
    }
    
}

?>