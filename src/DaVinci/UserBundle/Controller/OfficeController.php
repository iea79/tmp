<?php

namespace DaVinci\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use DaVinci\UserBundle\Form\Type\OfficePassengerProfileType;
use Symfony\Component\HttpFoundation\Request;

class OfficeController extends Controller
{
    /**
    * @Route("/choose-office", name="fos_user_registration_confirmed")
    * @Method("GET")
    * @Security("has_role('ROLE_USER') or has_role('ROLE_TAXIDRIVER') or has_role('ROLE_COMPANYDRIVER') or has_role('ROLE_TAXIMANAGER') or has_role('ROLE_TAXICOMPANY')")
    */
    public function office_chooseAction()
    {
        return $this->render('DaVinciUserBundle:Offices:office_choose.html.twig');
    }
    
    /**
    * @Route("/office-company", name="office_company")
    * @Security("has_role('ROLE_TAXICOMPANY')")
    */
    public function office_companyAction()
    {
        return $this->render('DaVinciUserBundle:Offices:office_company.html.twig');
    }
    
    /**
    * @Route("/office-passenger", name="office_passenger")
    * @Security("has_role('ROLE_USER')")
    */
    public function office_passengerAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        $form =$this->createForm(new OfficePassengerProfileType(), $user);

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            if ($form->isValid()) {

                $usr = $form->getData();
                
                $em = $this->container->get('doctrine')->getManager();
                $em->persist($usr->getUser());
                $em->flush();
                
                $this->setFlash('fos_user_success', 'profile.flash.updated');

                return new RedirectResponse($this->getRedirectionUrl($user));
            }
        }
        
        
        return $this->container->get('templating')->renderResponse('DaVinciUserBundle:Offices:office_passenger.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    /**
    * @Route("/office-driver", name="office_driver")
    * @Security("has_role('ROLE_TAXIDRIVER')")
    */
    public function office_driverAction()
    {
        return $this->render('DaVinciUserBundle:Offices:office_driver.html.twig');
    }

    /**
    * @Route("/block-profile", name="block_profile")
    * @Security("has_role('ROLE_USER')")
    */
    public function block_profileAction()
    {
        return $this->render('DaVinciUserBundle:Offices:block_profile.html.twig');
    }
    
    /**
    * @Route("/filter-table", name="filter_table")
    * @Security("has_role('ROLE_USER')")
    */   
    public function filter_tableAction()
    {
        return $this->render('DaVinciUserBundle:Home:filter_table.html.twig');
    }

    /**
    * @Route("/order-table", name="order_table")
    * @Security("has_role('ROLE_USER')")
    */   
    public function order_tableAction()
    {
        return $this->render('DaVinciUserBundle:Offices:order_table.html.twig');
    }
    
    /**
    * @Route("/dispet-table", name="dispet_table")
    * @Security("has_role('ROLE_USER')")
    */      
    public function dispet_tableAction()
    {
        return $this->render('DaVinciUserBundle:Offices:dispet_table.html.twig');
    }

}
