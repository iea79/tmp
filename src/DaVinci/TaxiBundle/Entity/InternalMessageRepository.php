<?php

namespace DaVinci\TaxiBundle\Entity;

/**
 * InternalMessageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InternalMessageRepository extends \Doctrine\ORM\EntityRepository
{
	
	/**
	 * @param \DaVinci\TaxiBundle\Entity\InternalMessage $internalMessage
	 * @return void
	 */
	public function save(\DaVinci\TaxiBundle\Entity\InternalMessage $internalMessage)
	{
		$this->_em->persist($internalMessage);
		$this->_em->flush();
	} 
	
}