<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine;

/**
 * IndependentDriverRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class IndependentDriverRepository extends EntityRepository 
{
	
	/**
	 * @param integer $userId
	 * @return \DaVinci\TaxiBundle\Entity\IndependentDriver
	 */
	public function findOneByUserId($userId)
	{
		$query = $this->_em->createQuery("
			SELECT
				driver
			FROM
				DaVinci\TaxiBundle\Entity\IndependentDriver driver
			WHERE
				driver.user = :userId
		");
		$query->setParameters(array('userId' => $userId));
		
		return $query->getOneOrNullResult();
	}
	
	public function save(\DaVinci\TaxiBundle\Entity\GeneralDriver $driver)
	{
		$this->_em->persist($driver);
		$this->_em->flush();
	}
	
}

?>