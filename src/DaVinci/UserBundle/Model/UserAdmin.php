<?php

namespace DaVinci\UserBundle\Model;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;

class UserAdmin extends SonataUserAdmin {

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper) {
        // define group zoning
        $formMapper
                ->with('Profile', array('class' => 'col-md-6'))
                ->with('General', array('class' => 'col-md-6'))
                ->with('Security', array('class' => 'col-md-6'))
                ->with('Management', array('class' => 'col-md-6'))
                ->with('Social', array('class' => 'col-md-6'))
        ;

        $now = new \DateTime();

        $formMapper
                ->with('General')
                //->add('username')
                ->add('email')
                ->add('plainPassword', 'text', array(
                    'required' => (!$this->getSubject() || is_null($this->getSubject()->getId()))
                ))
                ->end()
                ->with('Profile')
                ->add('firstname', null, array('required' => false))
                ->add('lastname', null, array('required' => false))
                ->add('website', 'url', array('required' => false))
                ->add('biography', 'text', array('required' => false))
                ->add('gender', 'sonata_user_gender', array(
                    'required' => true,
                    'translation_domain' => $this->getTranslationDomain()
                ))
                ->add('dateOfBirth', 'birthday', array('label' => 'form.dateOfBirth', 'translation_domain' => 'FOSUserBundle'))
                ->end()
                ->with('Social')
                ->add('facebookUid', null, array('required' => false))
                ->add('facebookName', null, array('required' => false))
                ->add('twitterUid', null, array('required' => false))
                ->add('twitterName', null, array('required' => false))
                ->add('gplusUid', null, array('required' => false))
                ->add('gplusName', null, array('required' => false))
                ->end()
        ;

        if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
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
            ;
        }

        $formMapper
                ->with('Security')
                ->add('token', null, array('required' => false))
                ->add('twoStepVerificationCode', null, array('required' => false))
                ->end()
        ;
    }

}
