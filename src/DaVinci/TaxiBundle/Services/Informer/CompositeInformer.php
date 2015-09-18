<?php

namespace DaVinci\TaxiBundle\Services\Informer;

use DaVinci\TaxiBundle\Entity\User;
use DaVinci\TaxiBundle\Entity\MessageContent;

class CompositeInformer extends AbstractInformer
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
	
	public function notify(User $user, $literalCode, $recipient)
	{
		foreach ($this->informers as $informer) {
			$informer->notify($user, $literalCode, $recipient);
		}
	}
    
    protected function process(User $user, MessageContent $contentInfo, $recipient)
    {
        return;
    }    
	
}

?>