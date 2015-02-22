<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class FaqEntryAdmin extends Admin
{
        
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('question')
            ->add('locale')
             ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }
    
    public function configureFormFields(FormMapper $formMapper) {
        
        $formMapper
                ->with('form.group_general')
                    ->add('question', 'text', array('label' => 'Question'))
                    ->add('answer', 'textarea', array('label' => 'Answer', 'attr'=>array('class'=>'ckeditor')))
                    ->add('forPassenger', 'checkbox', array('label' => 'Для пассажиров?'))
                    ->add('published', 'checkbox', array('label' => 'Опубликовать?'))  
                ->end()
                ->with('Other',  array('collapsed' => true))
                    ->add('parentDocument', 'doctrine_phpcr_odm_tree', array('root_node' => '/cms/faq', 'select_root_node' => '/cms/faq', 'choice_list' => array(), 'select_root_node' => true))
                    ->add('locale')
               ->end();
        
    }
}