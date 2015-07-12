<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class BlogColumnAdmin extends Admin
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
                ->add('isDefault', 'checkbox', array('label' => 'Is Default'))
                ->add('isActive', 'checkbox', array('label' => 'Is Active'))
                ->add('order', 'number', array('label' => 'Order', 'data' => 0))
                ->add(
                	'imagePreview',
                	'sonata_type_model_list',
                	array(
                		'required' => false,
                		'label' => 'Image preview for blog column'
                	),
                	array('link_parameters' => array(
                		'context' => 'blog',
                		'provider' => 'sonata.media.provider.image'
                	))
                )
			->end()
            ->with('Other',  array('collapsed' => true))
            	->add('locale')
 			->end();        
    }
    
    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/cms/blog-columns');
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