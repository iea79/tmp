<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;

class ProfitPageAdmin extends Admin
{

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('locale')
             ->add('_action', 'actions', array(
                'actions' => array(
             //     'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Main data')
                ->add('driverTab', 'checkbox' ,array('label' => 'is it driver profit?'))
                ->add('title', 'text',array('label' => 'Tab title'))
                ->add('block1', 'textarea',array('label' => 'Left block', 'attr'=>array('class'=>'ckeditor')))
                ->add('block2Title', 'text',array('label' => 'Middle block title'))
                ->add('block2', 'textarea',array('label' => 'Middle block', 'attr'=>array('class'=>'ckeditor')))
            ->end()
            ->with('Media data')    
                ->add('youtubeLink', 'sonata_type_model_list', array(
                        'required' => false,
                        'label' => 'Youtube link (left empty if no video)',
                    ), array(
                        'link_parameters' => array(
                            'context' => 'profit',
                            'provider' => 'sonata.media.provider.youtube',
                        ),
                    ))
            ->end()
            ->with('Other',  array('collapsed' => true))
                 ->add('parentDocument', 'doctrine_phpcr_odm_tree', array('root_node' => '/cms/profit', 'select_root_node' => '/cms/profit', 'choice_list' => array(), 'select_root_node' => true))
                 ->add('locale')
            ->end()
        ;

    }
}