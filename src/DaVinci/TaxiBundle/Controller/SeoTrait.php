<?php

namespace DaVinci\TaxiBundle\Controller;

trait SeoTrait 
{

    protected $params;

    /**
     * @param \DaVinci\TaxiBundle\Entity\Seo\Params 
     */
    public function setParams(\DaVinci\TaxiBundle\Entity\Seo\Params $params) 
    {
        $this->params = $params;
    }
    
    /**
     * @return \DaVinci\TaxiBundle\Entity\Seo\Params 
     */
    public function getParams() 
    {
        return $this->params;
    }
    
}
