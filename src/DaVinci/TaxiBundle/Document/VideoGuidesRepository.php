<?php
namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Id\RepositoryIdInterface;
use Doctrine\ODM\PHPCR\DocumentRepository as BaseDocumentRepository;

class VideoGuidesRepository extends BaseDocumentRepository implements RepositoryIdInterface
{
    /**
     * Generate a document id
     *
     * @param object $document
     * @return string
     */
    public function generateId($document, $parent = null)
    {
		$slugged = \Cocur\Slugify\Slugify::create()->slugify($document->getYoutubeLink()->getName());
        return '/cms/'.$parent.'/'.$slugged;
    }
}