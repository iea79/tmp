<?php

namespace DaVinci\TaxiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use DaVinci\TaxiBundle\Event\PassengerRequestEvents;
use DaVinci\TaxiBundle\Event\CommonDriverRequestEvent;

class DeclineUnconfirmedRequestsCommand extends ContainerAwareCommand
{
	
	protected function configure()
	{
		$this
			->setName('decline:unconfirmed:requests')
			->setDescription('Declining of uncofirmed passenger requests');
	}
	
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$passengerRequestRepository = $this->getPassengerRequestRepository();
		$requests = $passengerRequestRepository->getExpiredRequests();
	
		foreach ($requests as $passengerRequest) {
			$dispatcher = $this->container->get('event_dispatcher');
			$dispatcher->dispatch(
				PassengerRequestEvents::DECLINE_DRIVER_REQUEST,
				new CommonDriverRequestEvent(
					$passengerRequest,
					$this->getPassengerRequestRepository(),
					$passengerRequest->getDriver(),
					$this->getIndependentDriverRepository()
				)
			);
		}
		
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\PassengerRequestRepository
	 */
	private function getPassengerRequestRepository()
	{
		$em = $this->getContainer()->get('doctrine')->getManager();
		return $em->getRepository('DaVinci\TaxiBundle\Entity\PassengerRequest');
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\IndependentDriverRepository
	 */
	private function getIndependentDriverRepository()
	{
		$em = $this->container->get('doctrine')->getManager();
		return $em->getRepository('DaVinci\TaxiBundle\Entity\IndependentDriver');
	}
	
}

?>