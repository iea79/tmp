<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class TermsAdmin extends Admin{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title')
            ->add('locale')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array()
                )
            ));
    }
    
    public function configureFormFields(FormMapper $formMapper) 
    {
        $formMapper
            ->with('General')
                ->add('title', 'text', array('label' => 'Title'))
                ->add('textBlock', 'ckeditor', array('label' => 'Text block'))
            ->end()
            ->with('Other',  array('collapsed' => true))
                ->add('locale')
            ->end();        
    }
    
    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/cms/terms');
        $document->setParentDocument($parent);
    }

    public function getExportFormats()
    {
        return array();
    }
    
    // protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    // {
    //     $datagridMapper->add('question', 'doctrine_phpcr_string');
    // }
    
}