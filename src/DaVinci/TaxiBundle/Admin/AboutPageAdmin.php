<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;


class AboutPageAdmin extends Admin
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

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Main data')
                ->add('title', 'text', array('label' => 'Tab title'))
                ->add('textBlock', 'ckeditor', array('label' => 'Text block'))
            ->end()
            ->with('Media data')
                ->add('buttonText', 'text', array('label' => 'Button text'))
                // ->add('buttonLink', 'choice', array(
                //     'choices' => $this->getConfigurationPool()->getContainer()->get('davinci.utils.url')->getPagesRoutes(),
                //     'label' => 'Button target URL'
                // ))
                ->add(
                    'youtubeLink', 
                    'sonata_type_model_list', 
                    array(
                        'required' => false,
                        'label' => 'Youtube link (left empty if no video)'
                    ), 
                    array('link_parameters' => array(
                        'context' => 'about',
                        'provider' => 'sonata.media.provider.youtube'
                    ))
                )                                
                ->add('textToLeft', 'checkbox', array('label' => 'Video to right side'))
            ->end()
            ->with('Other', array('collapsed' => true))
            	->add('locale')
    		->end();
    }

    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/cms/about');
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