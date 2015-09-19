<?php
namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Id\RepositoryIdInterface;
use Doctrine\ODM\PHPCR\DocumentRepository as BaseDocumentRepository;

class VideoGuidesRepository extends BaseDocumentRepository implements RepositoryIdInterface
{
	
	const PREFIX = 'videoguide-';
    
    /**
     * Generate a document id
     *
     * @param object $document
     * @return string
     */
    public function generateId($document, $parent = null)
    {
        $youtubeLink = $document->getYoutubeLink();
        
        if (!$youtubeLink) {
            $slugged = self::PREFIX . date('j-m-y-h-i-s');
        } else {
            $slugged = \Cocur\Slugify\Slugify::create()->slugify($youtubeLink->getName()) . '-' . date('j-m-y-h-i-s');
        }

        return '/cms/' . $parent . '/' . $slugged;
    }
    
}