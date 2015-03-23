<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class GuidesPageAdmin extends Admin {

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('locale')
             ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

        
    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/cms/guides');
        $document->setParentDocument($parent);
    }

    
    public function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->with('form.group_general')
                ->add('forPassenger', 'checkbox', array('label' => 'For passenger?'))
                ->add('title', 'text', array('required' => true))
                ->add('body', 'ckeditor', array('label' => 'Guite Text'))
                
            ->end()
            ->with('form.group_seo')
                ->add('seoMetadata', 'seo_metadata', array('label' => false))
            ->end()
            ->with('Other',  array('collapsed' => true))
                ->add('locale')
            ->end();
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title', 'doctrine_phpcr_string');
    }

    public function getExportFormats()
    {
        return array();
    }
}
