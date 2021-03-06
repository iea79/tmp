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
    // public function generateId($document, $parent = null)
    // {
    // 	if (!$document->getTitle()) {
    // 		$sluged = self::PREFIX . date('j-m-y-h-i-s');
    // 	} else {
    // 		$sluged = \Cocur\Slugify\Slugify::create()->slugify($document->getTitle());
    // 	}
    	
    // 	return '/cms' 
				// . '/' . $parent 
				// . '/' . $sluged;
    // }

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
    
    public function findForPassenger($trigger = true)
    {
    	return $this->findBy(
    		array('publishable' => true, 'forPassenger' => $trigger), 
    		array('order' => 'asc')
    	);
    }
    
    public function findFiltered($trigger = true, $category)
    {
        $filtered = array();
        
    	$guides = $this->findForPassenger($trigger);
        
        foreach ($guides as $key => $guide) {
            if ($guide->getCategory()->getId() == $category) {
                $filtered[$key] = $guide;
            }            
        }
        
        return $filtered;
    }
        
}