<?php

namespace DaVinci\TaxiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CancelExpiredRequestsCommand extends ContainerAwareCommand
{

	protected function configure()
	{
		$this
			->setName('cancel:expired:requests')
			->setDescription('Cancelation of expired passenger requests')
			->addOption(
				'requestId',
				'req_id',
				InputOption::VALUE_OPTIONAL							
			);
	}
	
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$passengerRequestRepository = $this->getPassengerRequestRepository();
		$requests = $passengerRequestRepository->getExpiredRequests();
		
		$count = 0;
		foreach ($requests as $passengerRequest) {
			$passengerRequest->cancelState();
			$passengerRequestRepository->save($passengerRequest);
			
			$count++;
		}
		
		$output->writeln("{$count} passenger requests has been canceled");
	}
		
	/**
	 * @return \DaVinci\TaxiBundle\Entity\PassengerRequestRepository
	 */
	private function getPassengerRequestRepository()
	{
		$em = $this->getContainer()->get('doctrine')->getManager();
		return $em->getRepository('DaVinci\TaxiBundle\Entity\PassengerRequest');
	}
	
}

?>