<?php

namespace DaVinci\TaxiBundle\Entity\Payment;

use Doctrine;
use Doctrine\ORM\EntityRepository;

/**
 * MakePaymentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MakePaymentRepository extends EntityRepository
{
	
	/**
	 * @param \DaVinci\TaxiBundle\Entity\Payment\MakePayment $operation
	 * @return void
	 */
	public function save(\DaVinci\TaxiBundle\Entity\Payment\MakePayment $operation)
	{
		$this->_em->persist($operation);
		$this->_em->persist($operation->getPaymentMethod());
		
		$this->_em->flush();
	}
	
}