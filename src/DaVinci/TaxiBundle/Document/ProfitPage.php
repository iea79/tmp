<?php

namespace DaVinci\TaxiBundle\Document;

use \Symfony\Cmf\Bundle\ContentBundle\Doctrine\Phpcr\StaticContent;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;


/**
 * @PHPCR\Document
 */
class ProfitPage extends StaticContent
{
    /**
     * @PHPCR\String(translated=true)
     */
    private $somestring;
    
    /**
     * @param mixed somestring
     */
    public function setSomestring($somestring)
    {
        $this->somestring = $somestring;
    }
        
    /**
     * @return somestring
     */
    public function getSomestring()
    {
        return $this->somestring;
    }
    
}