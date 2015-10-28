<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class VideoGuidesPageAdmin extends Admin 
{
	
	public $supportsPreviewMode = true;

    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/cms/videoguides');
        $document->setParentDocument($parent);
    }
    
    public function configureFormFields(FormMapper $formMapper) 
    {
		$formMapper
            ->with('General')
                ->add('forPassenger', 'checkbox', array('label' => 'For passenger'))
                ->add(
               		'youtubeLink', 
                	'sonata_type_model_list', 
                	array(
                        'required' => true,
                        'label' => 'YouTube link (left empty if no video)',
                    ), 
                	array(
                        'link_parameters' => array(
                            'context' => 'videoguides',
                            'provider' => 'sonata.media.provider.youtube',
                        )
                    )
 				)
                ->add('title', 'text', array('required' => true, 'attr' => array('placeholder' => 'Generated automaticly if emtpy')))
                ->add('category', 'sonata_type_model_list')
            ->end()
            ->with('form.group_general', array('collapsed' => true))
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
	    	->add('youtubeLink')
	    	->add('title')
	    	->add('_action', 'actions', array(
    			'actions' => array(
    				'edit' => array(),
    				'delete' => array()
    			)
	    	));
    }
    
}
