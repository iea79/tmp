<?php
namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\DocumentRepository as BaseDocumentRepository;

class CategoryRepository extends BaseDocumentRepository
{
	
	public function findDefault()
    {
    	return $this->findOneBy(
    		array('isDefault' => true)
    	);
    }
    
}

?>