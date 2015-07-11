<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class GuidesPageAdmin extends Admin 
{

    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/cms/guides');
        $document->setParentDocument($parent);
    }
    
    public function configureFormFields(FormMapper $formMapper) 
    {
        $formMapper
            ->with('General')
                ->add('forPassenger', 'checkbox', array('label' => 'For passenger'))
                ->add('title', 'text', array('required' => true))
                ->add('body', 'ckeditor', array('label' => 'Guide Text'))
                ->add('order', 'number', array('label' => 'Order', 'data' => 0))
                ->add('category', 'sonata_type_model_list')
            ->end()
            ->with('Other', array('collapsed' => true))
                ->add('locale')
            ->end();
    }
    
    public function getExportFormats()
    {
        return array();
    }
    
    protected function configureListFields(ListMapper $listMapper)
    {
    	$listMapper
	    	->add('forPassenger')
	    	->add('title')
	    	->add('locale')
	    	->add('_action', 'actions', array(
    			'actions' => array(
    				'edit' => array(),
    				'delete' => array()
    			)
	    	));
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    	$datagridMapper->add('title', 'doctrine_phpcr_string');
    }
    
}

?>