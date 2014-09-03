<?php

namespace DaVinci\UserBundle\Controller;

#use Sonata\UserBundle\Controller\RegistrationFOSUser1Controller as BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RegistrationController extends BaseController {

    
    /**
     * Tell the user to check his email provider
     */
    public function checkEmailAction()
    {
        //some shit code to not change main logic
        $email = $this->container->get('session')->get('fos_user_send_confirmation_email/email');
       
        $new_email=$email;
        
        $request = $this->container->get('request');
        if(!$email) {
            $post_data = $request->request->all();
            if(isset($post_data['form']))
            {
                $email = $post_data['form']['old_email'];
                $new_email = $post_data['form']['email'];
            }
        }

        $this->container->get('session')->remove('fos_user_send_confirmation_email/email');
        $user = $this->container->get('fos_user.user_manager')->findUserByEmail($email);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with email "%s" does not exist', $email));
        }
        
        $form = $this->container->get('form.factory')->createBuilder('form',$user)
                ->add('old_email','hidden', array("mapped" => false, 'data' => $email))
                ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
                ->add('save', 'submit', array('label' => 'Change or Resend', 'translation_domain' => 'FOSUserBundle'))
                ->getForm();

        $cloned = clone $form;
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database

            $this->container->get('fos_user.user_manager')->updateUser($user);
            $this->container->get('fos_user.mailer')->sendConfirmationEmailMessage($user);
            
            $form = $cloned;
            $form->add('old_email','hidden', array("mapped" => false, 'data' => $new_email))
                ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle','data'=>$new_email));
        }
        
        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:checkEmail.html.'.$this->getEngine(), array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }
    
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
        $request  = $this->container->get('request');
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

            //send to paygnet
            $this->container->get('paygnet')->registerUser($user->getEmail(),$user->getId());
        
        
            return $response;
        }
        
        
        if($flow->getCurrentStepNumber()==$flow->getFirstStepNumber())
            $this->container->get('session')->set('sonata_user_redirect_url', $this->container->get('request')->headers->get('referer'));

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.' . $this->getEngine(), array(
                    'form' => $form->createView(),
                    'flow' => $flow,
        ));
    }

}
