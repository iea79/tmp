<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use DaVinci\TaxiBundle\Entity\Offices;
use DaVinci\TaxiBundle\Event\SystemEvents;

class MessageContentAdmin extends Admin
{
    
    // Fields to be shown on create/edit forms
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('subject')
            ->add('content', 'ckeditor', array('label' => 'Content'))
            ->add('mailNotification', 'checkbox', array('label' => 'Mail notification'))
            ->add('internalNotification', 'checkbox', array('label' => 'Internal notification'))
            ->add('literalCode', 'choice', array(
                'choices' => SystemEvents::getDescriptionEventList()
            ))
            ->add('recipient', 'choice', array(
                'choices' => Offices::getDescriptionList()
            ));
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('subject')
            ->add('literalCode')
            ->add('recipient');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('subject')
            ->add('literalCode', 'choice', array(
                'choices' => SystemEvents::getDescriptionEventList()
            ))
            
            ->add('recipient', 'choice', array(
                'choices' => Offices::getDescriptionList()
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
	    			'delete' => array(),
                )
            ));
    }
}