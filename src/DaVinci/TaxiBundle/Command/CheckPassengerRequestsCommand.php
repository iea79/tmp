<?php

namespace DaVinci\TaxiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckPassengerRequestsCommand extends ContainerAwareCommand
{

	protected function configure()
	{
		$this
			->setName('check:passenger:requests')
			->setDescription('Check states of passenger requests')
			->addOption(
				'requestId',
				'req_id',
				InputOption::VALUE_OPTIONAL							
			);
	}
	
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		
	}
	
}

?>