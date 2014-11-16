<?php

namespace DaVinci\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use DaVinci\UserBundle\Form\Type\OfficePassengerProfileType;
use Symfony\Component\HttpFoundation\Request;
use DaVinci\UserBundle\Form\Type\OfficeDriverProfileType;

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
    * @Route("/office-passenger-profile", name="office_passenger_profile")
    * @Security("has_role('ROLE_USER')")
    */
    public function office_passenger_profileAciton(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (empty($user))
            throw new NotFoundHttpException(sprintf('There is empty user, try login'));
        
       
        $isPassExp = !$user->isPasswordNotExpired();
         
        $form =$this->createForm(new OfficePassengerProfileType(), $user);

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            if ($form->isValid()) {

                $usr = $form->getData();
               
                //set new password if added
                if(!empty($form['current_password']->getData()))
                {
                    $user->setPlainPassword($form['new']->getData());
                }
                $this->container->get('fos_user.user_manager')->updateUser($usr);
                
                return new \Symfony\Component\HttpFoundation\Response('success',200); ;
            }
        }
        
        
        return $this->container->get('templating')->renderResponse('DaVinciUserBundle:Offices:office_passenger_profile_edit_form.html.twig', array(
                    'form' => $form->createView(),
                    'isPasswordExpired' => $isPassExp
        ));
    }
    
    
    /**
    * @Route("/office-passenger", name="office_passenger")
    * @Security("has_role('ROLE_USER')")
    */
    public function office_passengerAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (null === $user) {
            return new RedirectResponse($this->container->get('router')->generate('fos_user_security_login'));
        }
        
        return $this->container->get('templating')->renderResponse('DaVinciUserBundle:Offices:office_passenger.html.twig');
    }

        /**
    * @Route("/office-driver-profile", name="office_driver_profile")
    * @Security("has_role('ROLE_TAXIDRIVER')")
    */
    public function office_driver_profileAciton(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (empty($user))
            throw new NotFoundHttpException(sprintf('There is empty user, try login'));
        
        $form =$this->createForm(new OfficeDriverProfileType(), $user->getDriver());

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            if ($form->isValid()) {

                $usr = $form->getData();
               

                $this->container->get('fos_user.user_manager')->updateUser($usr);
                
                return new \Symfony\Component\HttpFoundation\Response('success',200); ;
            }
        }
        
        
        return $this->container->get('templating')->renderResponse('DaVinciUserBundle:Offices:office_driver_profile_edit_form.html.twig', array(
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
