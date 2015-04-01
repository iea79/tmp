<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\MediaBundle\PHPCR;

use Application\Sonata\MediaBundle\PHPCR\BaseMediaRepository;
use Doctrine\ODM\PHPCR\Id\RepositoryIdInterface;

/**
 * This file has been generated by the EasyExtends bundle ( http://sonata-project.org/bundles/easy-extends )
 *
 * References :
 *   query builder     : http://www.doctrine-project.org/docs/mongodb_odm/1.0/en/reference/query-builder-api.html
 *
 * @author <yourname> <youremail>
 */
class MediaRepository extends BaseMediaRepository implements RepositoryIdInterface
{
    /**
     * Generate a document id
     *
     * @param object $document
     * @return string
     */
    public function generateId($document, $parent = null)
    {
        
        $slugged = \Cocur\Slugify\Slugify::create()->slugify($document->getName()).'-'.date('j-m-y-h-i-s');

        return '/'.$parent.'/'.$slugged;
    }
}