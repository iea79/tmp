<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\MediaBundle\Document;

use Sonata\MediaBundle\Document\BaseMedia as BaseMedia;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use DaVinci\TaxiBundle\Document\ContentTrait;

/**
 * @author Mykola Sedletskyi
 * @PHPCR\Document(referenceable = true, translator="attribute", repositoryClass="ContentRepository")
 */

class Media extends BaseMedia
{
    use ContentTrait;
}