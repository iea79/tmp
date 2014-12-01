<?php

namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="route_detail")
 */
class RouteDetail {
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\OneToMany(targetEntity="RoutePoint", mappedBy="routeDetail")
	 */
	private $routePoints;
	
	/**
	 * @ORM\OneToOne(targetEntity="PassengerRequest", inversedBy="routeDetail")
	 * @ORM\JoinColumn(name="request_id", referencedColumnName="id")
	 */
	private $passengerRequest;
	
	public function __construct() {
		$this->routePoints = new ArrayCollection();
	}
	
}
