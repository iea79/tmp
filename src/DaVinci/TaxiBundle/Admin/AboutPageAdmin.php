<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class AboutPageAdmin extends Admin
{
	
	const DEFAULT_TEXT_BLOCK = "<p>We offer you an unique taxi service:</p>
			<ul class='mp-check'>
		  		<li>You set a price for your ride</li>
		  		<li>The drivers like your price and send you an info about them and their cars</li>
		  		<li>You choose the driver you like</li>
		  		<li>You can skype the driver if you hire him or not</li>
		  		<li>You decide how much and when and in which way to pay a tip</li>
		  		<li>Mainly, the taxi drivers are customer-oriented and friendly</li>
		  		<li>Many cars are equiped for kids, disabled people, pets etc... </li>
			</ul>";
	
	public function getExportFormats()
	{
		return array();
	}
	
	public function prePersist($document)
	{
		$parent = $this->getModelManager()->find(null, '/cms/about');
		$document->setParentDocument($parent);
	}
	
    public function getNewInstance()
    {
        // load some standart markup data
        $instance = parent::getNewInstance();
        $instance->setTextBlock(self::DEFAULT_TEXT_BLOCK);

        return $instance;
    }
    
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

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Main data')
                ->add('title', 'text', array('label' => 'Tab title'))
                ->add('textBlock', 'ckeditor', array('label' => 'Text block'))
            ->end()
			->with('Media data')    
                ->add('buttonText', 'text', array('label' => 'Button text'))
                ->add('buttonLink', 'choice', array(
                    'choices' => $this->getConfigurationPool()->getContainer()->get('davinci.utils.url')->getPagesRoutes(),
                    'label' => 'Button target URL'
                ))
                ->add(
                	'youtubeLink', 
                	'sonata_type_model_list', 
                	array(
                        'required' => false,
                        'label' => 'Youtube link (left empty if no video)'
                    ), 
                	array(
                        'link_parameters' => array(
                            'context' => 'about',
                            'provider' => 'sonata.media.provider.youtube'
                    	)
                    ))
                ->add('textToLeft', 'checkbox', array('label' => 'Is video to right?'))
			->end()
            ->with('Comments') 
            	->add(
            		'comments', 
            		'sonata_type_collection', 
            		array(
                        'cascade_validation' => true,
                        'by_reference' => true,
                        'btn_add' => 'link_add',
                    ), 
            		array(
                        'edit' => 'inline',
                        'inline' => 'standard', // standard|table
                        'expanded' => true,
                        'multiple' => true,
                        // 'sortable'          => 'sort_order',
                        // 'link_parameters'   => array('context' => $context),
                        // 'admin_code'        => 'davinci.admin.fakecomment',
                    )
                )
            ->end()
            ->with('Other', array('collapsed' => true))
            	->add('locale')
    		->end();
    }
        
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title', 'doctrine_phpcr_string');
    }
    
}