<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SeoParamsAdmin extends Admin
{
    
    // Fields to be shown on create/edit forms
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('actionName', 'text', array('label' => 'Action name'))
            ->add('actionPath', 'text', array('label' => 'URL path'))
            ->add('seoTitle', 'text', array('label' => 'Seo title'))
            ->add('seoKeywords', 'text', array('label' => 'Seo keywords'))
            ->add('seoDescription', 'text', array('label' => 'Seo description'));
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('seoTitle')
            ->add('seoKeywords')
            ->add('seoDescription');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
	    	->add('seoTitle')
	    	->addIdentifier('seoKeywords')
	    	->add('seoDescription')
	    	->add('_action', 'actions', array(
	    		'actions' => array(
	    			'edit' => array(),
	    			'delete' => array(),
	    		)
	    	));        
    }
}