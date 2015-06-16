<?php

namespace DaVinci\TaxiBundle\Services\FakeRequest;

class FakeBuilder
{
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\PassengerRequestService
	 */
	private $requestService;
	
	/**
	 * @var \DaVinci\TaxiBundle\Services\FakeRequest\DesignerInterface
	 */
	private $designer;
		
	public function __construct(
		\DaVinci\TaxiBundle\Entity\PassengerRequestService $requestService,
		\DaVinci\TaxiBundle\Services\FakeRequest\DesignerInterface $designer
	) {
		$this->requestService = $requestService;
		$this->designer = $designer;
	}
	
	public function run()
	{
		$request = $this->requestService->generateRequest();
		$this->designer->modify($request);
		
		return $request;
	}
			
}

?>