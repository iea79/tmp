<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class FaqEntryAdmin extends Admin{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
			->add('forPassenger')
        	->addIdentifier('question')
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
                ->add('forPassenger', 'checkbox', array('label' => 'For passengers'))
                ->add('question', 'text', array('label' => 'Question'))
                ->add('answer', 'ckeditor', array('label' => 'Answer'))
                ->add('published', 'checkbox', array('label' => 'Is published'))
                ->add('order', 'number', array('label' => 'Order', 'data' => 0))
                ->add('category', 'sonata_type_model_list')
			->end()
            ->with('Other',  array('collapsed' => true))
            	->add('locale')
 			->end();        
    }
    
    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/cms/faq');
        $document->setParentDocument($parent);
    }

    public function getExportFormats()
    {
        return array();
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    	$datagridMapper->add('question', 'doctrine_phpcr_string');
    }
    
}