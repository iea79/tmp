<?php

namespace DaVinci\TaxiBundle\Services\Informer;

use DaVinci\TaxiBundle\Entity\User;

class CompositeInformer extends AbstractInformer implements InformerInterface
{
	
	/**
	 * @var array
	 */
	private $informers = array(); 
	
	public function add(InformerInterface $informer)
	{
		$this->informers[get_class($informer)] = $informer; 
	}
	
	public function remove(InformerInterface $informer)
	{
		unset($this->informers[get_class($informer)]);
	}
	
	public function notify(\DaVinci\TaxiBundle\Entity\User $user, $literalCode)
	{
		foreach ($this->informers as $informer) {
			$informer->notify($user, $literalCode);
		}
	}
	
}

?>