<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class ProfitPageAdmin extends Admin
{
    function getNewInstance()
    {
        //load some standart markup data
        $instance = parent::getNewInstance();
        $instance->setBlock1('<h2>Some title</h2>
							<ul class="uk-width-1-1">
								<li>list item 1</li>
								<li>list item 2</li>
							</ul>');
        $instance->setBlock2Title('Block 2 title');
        $instance->setBlock2('<ol class="uk-width-1-1">
						        <li>list item 1</li>
   					    	    <li>list item 2</li>
						        <li>list item 3</li>
						  	</ol>');

        return $instance;
    }
    
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('locale')
             ->add('_action', 'actions', array(
                'actions' => array(
             //     'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Main data')
                ->add('driverTab', 'checkbox' ,array('label' => 'is it driver profit?'))
                ->add('title', 'text',array('label' => 'Tab title'))
                ->add('block1', 'ckeditor',array('label' => 'Left block'))
                ->add('block2Title', 'text',array('label' => 'Middle block title'))
                ->add('block2', 'ckeditor',array('label' => 'Middle block'))
            ->end()
            ->with('Media data')    
                ->add('youtubeLink', 'sonata_type_model_list', array(
                        'required' => false,
                        'label' => 'Youtube link (left empty if no video)',
                    ), array(
                        'link_parameters' => array(
                            'context' => 'profit',
                            'provider' => 'sonata.media.provider.youtube',
                        ),
                    ))
            ->end()
            ->with('Other',  array('collapsed' => true))
                 //->add('parentDocument', 'doctrine_phpcr_odm_tree', array('root_node' => '/cms/profit', 'select_root_node' => '/cms/profit', 'choice_list' => array(), 'select_root_node' => true))
                 ->add('locale')
            ->end()
        ;

    }
    
            
    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/cms/profit');
        $document->setParentDocument($parent);
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