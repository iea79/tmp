<?php

namespace DaVinci\UserBundle\Controller;

#use Sonata\UserBundle\Controller\RegistrationFOSUser1Controller as BaseController;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use DaVinci\TaxiBundle\Entity\TaxiCompany;
use DaVinci\TaxiBundle\Entity\IndependentDriver;
use DaVinci\TaxiBundle\Services\Remote\RemoteRequester;

class RegistrationController extends BaseController 
{

    /**
     * Receive the confirmation token from user email provider, login the user
     */
    public function confirmAction($token)
    {
        $user = $this->container->get('fos_user.user_manager')->findUserByConfirmationToken($token);

        if (null === $user) {
            //TODO: add message page/notification
            return new RedirectResponse($this->container->get('router')->generate('fos_user_security_login'));
            //throw new NotFoundHttpException(sprintf('The user with confirmation token "%s" does not exist', $token));
        }

        $user->setConfirmationToken(null);
        $user->setEnabled(true);
        $user->setLastLogin(new \DateTime());

        $this->container->get('fos_user.user_manager')->updateUser($user);
        $response = new RedirectResponse($this->container->get('router')->generate('fos_user_registration_confirmed'));
        $this->authenticateUser($user, $response);

        return $response;
    }
    
    /**
     * Tell the user to check his email provider
     */
    public function checkEmailAction() {
        //some shit code to not change main logic
        $email = $this->container->get('session')->get('fos_user_send_confirmation_email/email');

        if (empty($email))
            throw new NotFoundHttpException(sprintf('There is empty check email, try register'));


        $new_email = $email;
        $request = $this->container->get('request');
        $post_data = $request->request->all();
        if (isset($post_data['form']))
            $new_email = $post_data['form']['email'];

        //$this->container->get('session')->remove('fos_user_send_confirmation_email/email');
        $user = $this->container->get('fos_user.user_manager')->findUserByEmail($email);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with email "%s" does not exist', $email));
        }

        $form = $this->container->get('form.factory')->createBuilder('form', $user,array('validation_groups'=>'CheckEmail'))
                ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
                ->add('save', 'submit', array('label' => 'Change and Resend', 'translation_domain' => 'FOSUserBundle'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database

            $this->container->get('fos_user.user_manager')->updateUser($user);
            $this->container->get('fos_user.mailer')->sendConfirmationEmailMessage($user);
            $this->container->get('session')->set('fos_user_send_confirmation_email/email', $new_email);

            $form = $this->container->get('form.factory')->createBuilder('form', $user)
                    ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'data' => $new_email))
                    ->add('save', 'submit', array('label' => 'Change and Resend', 'translation_domain' => 'FOSUserBundle'))
                    ->getForm();
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:checkEmail.html.' . $this->getEngine(), array(
                    'user' => $user,
                    'form' => $form->createView(),
        ));
    }

    /**
     * fosuser register standard route /register
     */
    public function registerAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();

        if ($user instanceof UserInterface) {
            $this->container->get('session')->getFlashBag()->set('sonata_user_error', 'sonata_user_already_authenticated');
            $url = $this->container->get('router')->generate('sonata_user_profile_show');

            return new RedirectResponse($url);
        }

        //$form = $this->container->get('sonata.user.registration.form');
        //$formHandler = $this->container->get('sonata.user.registration.form.handler');
        // $formHandler = $this->container->get('fos_user.registration.form.handler');



        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        ////// form handler moved here to use craue flow bundle
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();

        $flow = $this->container->get('taxi.registration.form.flow'); // must match the flow's service id

        $flow->bind($user);
        $form = $flow->createForm();

        $process = false;
        $request = $this->container->get('request');
        if ($request->isMethod('POST')) {
            //$form->bind($request);
            if ($flow->isValid($form)) {

                $flow->saveCurrentStepData($form);

                if ($flow->nextStep()) {
                    // form for the next step
                    $form = $flow->createForm();
                } else {
                    // flow finished
                    $flow->reset(); // remove step data from the session
                    if ($confirmationEnabled) {
                        $user->setEnabled(false);
                        if (null === $user->getConfirmationToken()) {
                            $user->setConfirmationToken($this->container->get('fos_user.util.token_generator')->generateToken());
                        }

                        $this->container->get('fos_user.mailer')->sendConfirmationEmailMessage($user);
                    } else {
                        $user->setEnabled(true);
                    }
                    $user->addRole('ROLE_USER');

                    $userManager->updateUser($user);

                    $process = true;
                }
            }
        }


        if ($process) {

            $user = $form->getData();

            $authUser = false;
            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $url = $this->container->get('router')->generate('fos_user_registration_check_email');
            } else {
                $authUser = true;
                $route = $this->container->get('session')->get('sonata_basket_delivery_redirect');

                if (null !== $route) {
                    $this->container->get('session')->remove('sonata_basket_delivery_redirect');
                    $url = $this->container->get('router')->generate($route);
                } else {
                    $url = $this->container->get('session')->get('sonata_user_redirect_url');
                }
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');

            $response = new RedirectResponse($url);

            if ($authUser) {
                $this->authenticateUser($user, $response);
            }

            // send to payment global network system
            $this->container->get('da_vinci_taxi.service.remote_requester')->makeUserOperation(
            	$user, RemoteRequester::OPCODE_CREATE_USER_ACCOUNT
        	);

            return $response;
        }


        if ($flow->getCurrentStepNumber() == $flow->getFirstStepNumber())
            $this->container->get('session')->set('sonata_user_redirect_url', $this->container->get('request')->headers->get('referer'));

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.' . $this->getEngine(), array(
                    'form' => $form->createView(),
                    'flow' => $flow,
        ));
    }

    /**
     * @Route("/register-company", name="register_company") 
     * @Security("has_role('ROLE_USER')")
     */
    public function register_companyAction() {

        if ($this->container->get('security.context')->isGranted('ROLE_TAXICOMPANY')) {
            return new RedirectResponse($this->container->get('router')->generate('office_company'));
        }

        $user = $this->container->get('security.context')->getToken()->getUser();

        $formData = new TaxiCompany();

        $formData->setAddress(new \DaVinci\TaxiBundle\Entity\Address());
        $formData->addPhone(new \DaVinci\TaxiBundle\Entity\Phone());
        $flow = $this->container->get('taxi.registration.company.form.flow'); // must match the flow's service id

        $flow->bind($formData);
        $form = $flow->createForm();

        $process = false;
        $request = $this->container->get('request');
        if ($request->isMethod('POST')) {
            //$form->bind($request);
            if ($flow->isValid($form)) {

                $flow->saveCurrentStepData($form);

                if ($flow->nextStep()) {
                    // form for the next step
                    $form = $flow->createForm();
                } else {

                    $user->addRole('ROLE_TAXICOMPANY');
                    $formData->setUser($user);
                    $em = $this->container->get('doctrine')->getManager();
                    $em->persist($formData);
                    $em->flush();

                    $flow->reset(); // remove step data from the session

                    $url = $this->container->get('router')->generate('office_company');

                    return new RedirectResponse($url);
                }
            }
        }


        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register_company.html.twig', array(
                    'form' => $form->createView(),
                    'user' => $user,
                    'flow' => $flow,
        ));
    }

    /**
     * @Route("/register-independent-driver", name="register_independent_driver") 
     * @Security("has_role('ROLE_USER')")
     */
    public function register_independent_driverAction() {
        if ($this->container->get('security.context')->isGranted('ROLE_TAXIDRIVER')) {
            return new RedirectResponse($this->container->get('router')->generate('office_driver'));
        }

        $user = $this->container->get('security.context')->getToken()->getUser();
        if (empty($user))
            throw new NotFoundHttpException(sprintf('There is empty user, try login'));


        $formData = new IndependentDriver();

        $formData->setAddress(new \DaVinci\TaxiBundle\Entity\Address());
        $formData->addPhone(new \DaVinci\TaxiBundle\Entity\Phone()); 
        if($user->getLanguage() == NULL){
            $user->setLanguage(new \DaVinci\TaxiBundle\Entity\Language());
        }
        $formData->setUser($user);
        
        $flow = $this->container->get('taxi.registration.independent.driver.form.flow'); // must match the flow's service id

        $flow->bind($formData);
        $form = $flow->createForm();

        $process = false;
        $request = $this->container->get('request');
        if ($request->isMethod('POST')) {
            //$form->bind($request);
            if ($flow->isValid($form)) {

                $flow->saveCurrentStepData($form);

                if ($flow->nextStep()) {
                    // form for the next step
                    $form = $flow->createForm();
                } else {

                    

                    $em = $this->container->get('doctrine')->getManager();
                    
                    $em->merge($formData);
                    $em->flush();

                    $flow->reset(); // remove step data from the session
                    
                    $user->addRole('ROLE_TAXIDRIVER');
                    $this->container->get('fos_user.user_manager')->updateUser($user);
                    
                    $url = $this->container->get('router')->generate('office_driver');

                    $response = new RedirectResponse($url);
					$this->authenticateUser($user, $response);
					return $response;
                }
            }
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register_independent_driver.html.twig', array(
                    'form' => $form->createView(),
                    'user' => $user,
                    'flow' => $flow,
        ));
    }

    /**
     * @Route("/register-manager", name="register_manager") 
     * @Security("has_role('ROLE_USER')")
     */
    public function register_managerAction() {
        return $this->container->get('templating')->renderResponse('DaVinciUserBundle:Registration:register_manager.html.twig');
    }

    /**
     * @Route("/register-company-driver", name="register_company_driver") 
     * @Security("has_role('ROLE_USER')")
     */
    public function register_company_driverAction() {
        return $this->container->get('templating')->renderResponse('DaVinciUserBundle:Registration:register_company_driver.html.twig');
    }

}
