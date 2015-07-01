<?php
namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Id\RepositoryIdInterface;
use Doctrine\ODM\PHPCR\DocumentRepository as BaseDocumentRepository;

class AboutRepository extends BaseDocumentRepository implements RepositoryIdInterface
{
	
	const ROOT_ABOUT = 'root-about';
	
    /**
     * Generate a document id
     *
     * @param object $document
     * @return string
     */
    public function generateId($document, $parent = null)
    {
		$slugged = \Cocur\Slugify\Slugify::create()->slugify($document->getTitle());
		
		return (is_null($parent)
			? '/cms/' . self::ROOT_ABOUT . '/' . $slugged
			: '/cms/' . $parent . '/' . $slugged);
    }
    
}