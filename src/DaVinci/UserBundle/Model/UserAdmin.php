<?php

namespace DaVinci\UserBundle\Model;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;

/**
* 
*/

class UserAdmin extends SonataUserAdmin {

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper) {
        // define group zoning
       $formMapper
                ->tab('User')
					->with('General', array('class' => 'col-md-6'))->end()
					->with('Profile', array('class' => 'col-md-6'))->end()
                    ->with('Independent driver', array('class' => 'col-md-6'))->end()   
                    ->with('Company driver', array('class' => 'col-md-6'))->end()   
                    ->with('Company manager', array('class' => 'col-md-6'))->end()   
                    ->with('Company', array('class' => 'col-md-6'))->end()   
                ->end()
                ->tab('Security')
					->with('Management', array('class' => 'col-md-6'))->end()
					->with('Security', array('class' => 'col-md-6'))->end()
                ->end()
        ;

        $now = new \DateTime();

        $formMapper
                ->tab('User') 
					->with('General')
						//->add('username')
						->add('email')
						->add('plainPassword', 'text', array(
							'required' => (!$this->getSubject() || is_null($this->getSubject()->getId()))
						))
                        ->add('photo', 'iphp_file', array(
                                'required' => false,
                                'label' => 'Avatar'
                                ))
					->end()
					->with('Profile')
						->add('firstname', null, array('required' => false))
						->add('lastname', null, array('required' => false))
						->add('gender', 'sonata_user_gender', array(
							'required' => true,
							'translation_domain' => $this->getTranslationDomain()
						))
                        ->add('skype', null, array('required' => false,'label' => 'Skype'))
						->add('dateOfBirth', 'birthday', array('label' => 'Date of birth'))
                        ->add('phone','text', array('label' => 'Mobile', 'attr'=>array('class' => 'phone')))
					->end() 
                    ->with('Independent driver')
                       // ->add('independentDriver.phones','sonata_type_collection',array('required' => false,'label' => 'Phones'))
                        //->add('independentDriver.about','text',array('required' => false,'label' => 'About me'))
                    ->end()
				/*	->with('Social')
						->add('facebookUid', null, array('required' => false))
						->add('facebookName', null, array('required' => false))
						->add('twitterUid', null, array('required' => false))
						->add('twitterName', null, array('required' => false))
						->add('gplusUid', null, array('required' => false))
						->add('gplusName', null, array('required' => false))
					->end()*/
                ->end()
        ;

        if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
					->tab('Managment')
						->with('Management')
							->add('groups', 'sonata_type_model', array(
								'required' => false,
								'expanded' => true,
								'multiple' => true
							))
							->add('realRoles', 'sonata_security_roles', array(
								'label' => 'form.label_roles',
								'expanded' => true,
								'multiple' => true,
								'required' => false
							))
							->add('locked', null, array('required' => false))
							->add('expired', null, array('required' => false))
							->add('enabled', null, array('required' => false))
							->add('credentialsExpired', null, array('required' => false))
						->end()
					->end()
            ;

            $formMapper
                    ->tab('Payment')
                        ->with('Fake Money', array('class' => 'col-md-6'))
							->add('fakeMoney', null, array('required' => false,'label' => 'Count'))
                        ->end()
                        ->with('Busness Money', array('class' => 'col-md-6'))

                        	
                        ->end()

                    ->end()
            ;
        }

        $formMapper
                ->tab('Security')
					->with('Security')
						->add('token', null, array('required' => false))
						->add('twoStepVerificationCode', null, array('required' => false))
					->end()
                ->end()
        ;
    }

}
