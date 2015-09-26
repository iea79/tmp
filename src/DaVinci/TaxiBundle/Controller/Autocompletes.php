<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Autocompletes extends Controller {
    /**
	 * @Route("/ajax_car_by_maker", name="ajax_car_by_maker", condition="request.headers.get('X-Requested-With') == 'XMLHttpRequest'")
     * @Method({"GET"})
	 */
/*    public function carByMakerAction(Request $request) {
            $make = $request->get('make');

            $qr = $this->getDoctrine()->getManager()->getRepository('DaVinciTaxiBundle:Admin\VehicleModelYear');;
            $qb = $qr->createQueryBuilder('u');
            
            $qb->select('u.model')
               ->where("replace( LOWER(u.make) ,  ' ',  '' ) = :make")
                ->setParameter(':make', $make);

            $result = $qb->getQuery()->getArrayResult();

            $json = array();
            foreach ($result as $model) {
                $json[str_replace(' ','',strtolower($model["model"]))] = $model["model"];
            }

            $response = new Response(json_encode($json));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
    }*/
}