<?php
namespace DaVinci\TaxiBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CountryCityAdmin extends Admin
{
    protected $baseRouteName = 'sonate_countries';
    protected $baseRoutePattern = 'sonate_countries';
    
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('countryCode', 'country', array('label' => 'admin.countrycity'))
            ->add('translations', 'a2lix_translations')
            ->add('status', 'choice', 
                    array('choices'   => array('0' => 'Disabled', '1' => 'Enabled'),
                        'data'=> '1'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('countryCode')
            ->add('translations.city')
            ->add('status')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('countryCode')
            ->addIdentifier('city')
            ->add('status')
        ;
    }
}