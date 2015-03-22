<?php

namespace DaVinci\TaxiBundle\Admin;

use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class VideoGuidesPageAdmin extends Admin {

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('forPassenger')
            ->add('youtubeLink')
             ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

        
    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/cms/videoguides');
        $document->setParentDocument($parent);
    }

    
    public function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->with('form.group_general')
                ->add('forPassenger', 'checkbox', array('label' => 'For passenger?'))
                ->add('youtubeLink', 'sonata_type_model_list', array(
                        'required' => true,
                        'label' => 'Youtube link (left empty if no video)',
                    ), array(
                        'link_parameters' => array(
                            'context' => 'videoguides',
                            'provider' => 'sonata.media.provider.youtube',
                        ),
                    ))
            ->end()
            ->with('form.group_seo')
                ->add('seoMetadata', 'seo_metadata', array('label' => false))
            ->end()
            ->with('Other')
                ->add('locale')
            ->end();
    }

    public function getExportFormats()
    {
        return array();
    }
}
