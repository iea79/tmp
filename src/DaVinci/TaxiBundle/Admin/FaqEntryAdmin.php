<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

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
                    ->add('answer', 'ckeditor', array('label' => 'Answer'))
                    ->add('forPassenger', 'checkbox', array('label' => 'For passengers?'))
                    ->add('published', 'checkbox', array('label' => 'Publish?'))  
                ->end()
                ->with('Other',  array('collapsed' => true))
                   //->add('parentDocument', 'doctrine_phpcr_odm_tree', array('root_node' => '/cms/faq', 'select_root_node' => '/cms/faq', 'choice_list' => array(), 'select_root_node' => true))
                    ->add('locale')
               ->end();
        
    }
    
    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/cms/faq');
        $document->setParentDocument($parent);
    }

    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('question', 'doctrine_phpcr_string');
    }

    public function getExportFormats()
    {
        return array();
    }
}