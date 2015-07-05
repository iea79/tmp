<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class CategoryAdmin extends Admin
{
        
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
			->addIdentifier('title')
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
                ->add('description', 'ckeditor', array('label' => 'Description'))
			->end()
            ->with('Other',  array('collapsed' => true))
            	->add('locale')
 			->end();        
    }
    
    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/cms/category');
        $document->setParentDocument($parent);
    }

    public function getExportFormats()
    {
        return array();
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    	$datagridMapper->add('title', 'doctrine_phpcr_string');
    }
    
}