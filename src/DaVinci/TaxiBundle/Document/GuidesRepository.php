<?php
namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Id\RepositoryIdInterface;
use Doctrine\ODM\PHPCR\DocumentRepository as BaseDocumentRepository;

class GuidesRepository extends BaseDocumentRepository implements RepositoryIdInterface
{
	
	const PREFIX = 'guide-';
	
    /**
     * Generate a document id
     *
     * @param object $document
     * @return string
     */
    public function generateId($document, $parent = null)
    {
    	if (!$document->getTitle()) {
    		$sluged = self::PREFIX . date('j-m-y-h-i-s');
    	} else {
    		$sluged = \Cocur\Slugify\Slugify::create()->slugify($document->getTitle());
    	}
    	
    	return '/cms' 
				. '/' . $parent 
				. '/' . $sluged;
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