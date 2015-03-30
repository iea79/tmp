<?php
namespace DaVinci\TaxiBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use DaVinci\TaxiBundle\Entity\UserComment;

class UserCommentAdmin extends Admin
{
    
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('text')
            ->add('user', 'sonata_type_model_list')
            ->add('type', 'choice', 
                    array('choices'   => UserComment::getTypeList())
                    )
            ->add('state', 'choice', 
                    array('choices'   => UserComment::getStateList())
                    );
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('type')
            ->add('text')
            ->add('state')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('type')
            ->add('text')
            ->add('state')
        ;
    }
}