<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class HalkAdmin extends Admin 
{

    public function configureFormFields(FormMapper $formMapper) 
    {
        $formMapper
            ->with('General')
                ->add('title', 'text', array('required' => false))
                ->add('preview', 'ckeditor', array('label' => 'Post Preview'))
                ->add('body', 'ckeditor', array('label' => 'Post Content'))
                ->add('isCommercial', 'checkbox', array('label' => 'Is Commercial'))
                ->add('order', 'number', array('label' => 'Order', 'data' => 0))
                ->add('blogColumn', 'sonata_type_model_list')
                ->add('seoTitle', 'text', array('label' => 'SEO Title', 'required' => false))
                ->add('seoKeywords', 'text', array('label' => 'SEO Keywords', 'required' => false))
                ->add('seoDescription', 'text', array('label' => 'SEO Description', 'required' => false))
                ->add(
                	'imagePreview',
                	'sonata_type_model_list',
                	array(
                		'required' => false,
                		'label' => 'Image preview for post'
                	),
                	array('link_parameters' => array(
                		'context' => 'blog',
                		'provider' => 'sonata.media.provider.image'
                	))
                )
            ->end()
            ->with('Other', array('collapsed' => true))
                ->add('locale')
            ->end();
    }
    
    public function prePersist($document)
    {
    	$parent = $this->getModelManager()->find(null, '/cms/halk');
    	$document->setParentDocument($parent);
    }
    
    public function getExportFormats()
    {
        return array();
    }
    
    protected function configureListFields(ListMapper $listMapper)
    {
    	$listMapper
	    	->addIdentifier('title')
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