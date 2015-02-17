<?php
namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Id\RepositoryIdInterface;
use Doctrine\ODM\PHPCR\DocumentRepository as BaseDocumentRepository;

class ProfitRepository extends BaseDocumentRepository implements RepositoryIdInterface
{
    
    public function getDriverProfitTab()
    {
        return $this->findBy(array('driverTab'=>true));
    }
    
    public function getPassengerProfitTab()
    {
        return $this->findBy(array('driverTab'=>false));
    }
    
    /**
     * Generate a document id
     *
     * @param object $document
     * @return string
     */
    public function generateId($document, $parent = null)
    {
        
        return '/cms/'.$parent.'/'.$document->getTitle();
    }
}