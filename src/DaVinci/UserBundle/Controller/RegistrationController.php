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
        $user = $this->get('fos_user.user_manager')->findUserByConfirmationToken($token);

        if (null === $user) {
            // TODO: add message page/notification
            return new RedirectResponse($this->get('router')->generate('fos_user_security_login'));
            // throw new NotFoundHttpException(sprintf('The user with confirmation token "%s" does not exist', $token));
        }

        $user->setConfirmationToken(null);
        $user->setEnabled(true);
        $user->setLastLogin(new \DateTime());

        $this->get('fos_user.user_manager')->updateUser($user);
        $response = new RedirectResponse($this->get('router')->generate('fos_user_registration_confirmed'));
        $this->authenticateUser($user, $response);

        return $response;
    }
    
    /**
     * Tell the user to check his email provider
     */
    public function checkEmailAction() 
    {
        // some shit code to not change main logic
        $email = $this->get('session')->get('fos_user_send_confirmation_email/email');

        if (empty($email)) {
            throw new NotFoundHttpException(sprintf('There is empty check email, try register'));
        }    

        $newEmail = $email;
        $request = $this->get('request');
        $postData = $request->request->all();
        if (isset($postData['form'])) {
            $newEmail = $postData['form']['email'];
        }

        // $this->get('session')->remove('fos_user_send_confirmation_email/email');
        $user = $this->get('fos_user.user_manager')->findUserByEmail($email);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with email "%s" does not exist', $email));
        }

        $form = $this->get('form.factory')->createBuilder(
            'form', $user, array('validation_groups' => 'CheckEmail'))
                ->add('email', 'email', array(
                    'label' => 'form.email', 'translation_domain' => 'FOSUserBundle'
                ))
                ->add('save', 'submit', array(
                    'label' => 'Change and Resend', 'translation_domain' => 'FOSUserBundle'
                ))
                ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            // perform some action, such as saving the task to the database

            $this->get('fos_user.user_manager')->updateUser($user);
            $this->get('fos_user.mailer')->sendConfirmationEmailMessage($user);
            $this->get('session')->set('fos_user_send_confirmation_email/email', $newEmail);

            $form = $this->get('form.factory')->createBuilder('form', $user)
                    ->add('email', 'email', array(
                        'label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'data' => $newEmail
                    ))
                    ->add('save', 'submit', array(
                        'label' => 'Change and Resend', 'translation_domain' => 'FOSUserBundle'
                    ))
                    ->getForm();
        }

        return $this->get('templating')->renderResponse(
            'FOSUserBundle:Registration:checkEmail.html.' . $this->getEngine(), 
            array(
                'user' => $user,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * fosuser register standard route /register
     */
    public function registerAction() 
    {
        $user = $this->get('security.context')->getToken()->getUser();

        if ($user instanceof UserInterface) {
            $this->get('session')->getFlashBag()->set('sonata_user_error', 'sonata_user_already_authenticated');
            $url = $this->get('router')->generate('sonata_user_profile_show');

            return new RedirectResponse($url);
        }

        // $form = $this->get('sonata.user.registration.form');
        // $formHandler = $this->get('sonata.user.registration.form.handler');
        // $formHandler = $this->get('fos_user.registration.form.handler');

        $confirmationEnabled = $this->getParameter('fos_user.registration.confirmation.enabled');

        ////// form handler moved here to use craue flow bundle
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->createUser();

        $flow = $this->get('taxi.registration.form.flow'); // must match the flow's service id
        $flow->bind($user);

        $form = $flow->createForm();

        $process = false;
        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            // $form->bind($request);
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
                            $user->setConfirmationToken(
                                $this->get('fos_user.util.token_generator')->generateToken()
                            );
                        }

                        $this->get('fos_user.mailer')->sendConfirmationEmailMessage($user);
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
                $this->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $url = $this->get('router')->generate('fos_user_registration_check_email');
            } else {
                $authUser = true;
                $route = $this->get('session')->get('sonata_basket_delivery_redirect');

                if (null !== $route) {
                    $this->get('session')->remove('sonata_basket_delivery_redirect');
                    $url = $this->get('router')->generate($route);
                } else {
                    $url = $this->get('session')->get('sonata_user_redirect_url');
                }
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');

            $response = new RedirectResponse($url);

            if ($authUser) {
                $this->authenticateUser($user, $response);
            }

            // send request to payment global network system
            $this->get('da_vinci_taxi.service.remote_requester')->makeUserOperation(
            	$user, RemoteRequester::OPCODE_CREATE_USER_ACCOUNT
        	);

            return $response;
        }


        if ($flow->getCurrentStepNumber() == $flow->getFirstStepNumber()) {
            $this
                ->get('session')
                ->set('sonata_user_redirect_url', $this->get('request')->headers->get('referer'));
        }    

        return $this->get('templating')->renderResponse(
            'FOSUserBundle:Registration:register.html.' . $this->getEngine(), 
            array(
                'form' => $form->createView(),
                'flow' => $flow,
            )
        );
    }

    /**
     * @Route("/register-company", name="register_company") 
     * @Security("has_role('ROLE_USER')")
     */
    public function register_companyAction() {

        if ($this->get('security.context')->isGranted('ROLE_TAXICOMPANY')) {
            return new RedirectResponse($this->get('router')->generate('office_company'));
        }

        $user = $this->get('security.context')->getToken()->getUser();

        $formData = new TaxiCompany();

        $formData->setAddress(new \DaVinci\TaxiBundle\Entity\Address());
        $formData->addPhone(new \DaVinci\TaxiBundle\Entity\Phone());
        $flow = $this->get('taxi.registration.company.form.flow'); // must match the flow's service id

        $flow->bind($formData);
        $form = $flow->createForm();

        $process = false;
        $request = $this->get('request');
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
                    $em = $this->get('doctrine')->getManager();
                    $em->persist($formData);
                    $em->flush();

                    $flow->reset(); // remove step data from the session

                    $url = $this->get('router')->generate('office_company');

                    return new RedirectResponse($url);
                }
            }
        }


        return $this->get('templating')->renderResponse('FOSUserBundle:Registration:register_company.html.twig', array(
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
        if ($this->get('security.context')->isGranted('ROLE_TAXIDRIVER')) {
            return new RedirectResponse($this->get('router')->generate('office_driver'));
        }

        $user = $this->get('security.context')->getToken()->getUser();
        if (empty($user))
            throw new NotFoundHttpException(sprintf('There is empty user, try login'));


        $formData = new IndependentDriver();

        $formData->setAddress(new \DaVinci\TaxiBundle\Entity\Address());
        $formData->addPhone(new \DaVinci\TaxiBundle\Entity\Phone()); 
        if($user->getLanguage() == NULL){
            $user->setLanguage(new \DaVinci\TaxiBundle\Entity\Language());
        }
        $formData->setUser($user);
        
        $flow = $this->get('taxi.registration.independent.driver.form.flow'); // must match the flow's service id

        $flow->bind($formData);
        $form = $flow->createForm();

        $process = false;
        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            //$form->bind($request);
            if ($flow->isValid($form)) {

                $flow->saveCurrentStepData($form);

                if ($flow->nextStep()) {
                    // form for the next step
                    $form = $flow->createForm();
                } else {

                    

                    $em = $this->get('doctrine')->getManager();
                    
                    $em->merge($formData);
                    $em->flush();

                    $flow->reset(); // remove step data from the session
                    
                    $user->addRole('ROLE_TAXIDRIVER');
                    $this->get('fos_user.user_manager')->updateUser($user);
                    
                    $url = $this->get('router')->generate('office_driver');

                    $response = new RedirectResponse($url);
					$this->authenticateUser($user, $response);
					return $response;
                }
            }
        }

        return $this->get('templating')->renderResponse('FOSUserBundle:Registration:register_independent_driver.html.twig', array(
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
        return $this->get('templating')->renderResponse('DaVinciUserBundle:Registration:register_manager.html.twig');
    }

    /**
     * @Route("/register-company-driver", name="register_company_driver") 
     * @Security("has_role('ROLE_USER')")
     */
    public function register_company_driverAction() {
        return $this->get('templating')->renderResponse('DaVinciUserBundle:Registration:register_company_driver.html.twig');
    }

}
