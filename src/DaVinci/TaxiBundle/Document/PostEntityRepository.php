<?php
namespace DaVinci\TaxiBundle\Document;

use Doctrine\ODM\PHPCR\Id\RepositoryIdInterface;
use Doctrine\ODM\PHPCR\DocumentRepository as BaseDocumentRepository;

class PostEntityRepository extends BaseDocumentRepository implements RepositoryIdInterface
{
	
	const PREFIX = 'post-entity-';
	
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
    
    public function findFilteredForColumn($columnId, $isCommercial = false)
    {
        $filtered = array();
        
    	$posts = $this->findBy(
    		array('isCommercial' => $isCommercial), 
    		array('order' => 'asc')
    	);
        
        foreach ($posts as $key => $post) {
            if ($post->getBlogColumn()->getId() == $columnId) {
                $filtered[$key] = $post;
            }            
        }
        
        return $filtered;
    }
        
    public function findCommonByColumn($columnId, $isCommercial = false)
    {
        $builder = $this->createQueryBuilder('query');
        $builder->fromDocument('DaVinciTaxiBundle:PostEntity', 'post')
            ->addJoinInner()
                ->right()->document('DaVinciTaxiBundle:BlogColumn', 'column')->end()
                ->condition()->equi('post.blogColumn', 'column.referrers')->end()
            ->end()
            ->where()
                ->andX()
                    ->eq()->field('column.id')->literal($columnId)->end()
                    ->eq()->field('post.isCommercial')->literal($isCommercial)->end()
            ->end();
        
        return $builder->getQuery()->getResult();
    }
    
}

?>