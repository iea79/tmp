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
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('text')
            ->add('user', 'sonata_type_model_list')
            ->add('rateLevel', 'choice', array(
                'choices' => UserComment::getRateList()
            ))
            ->add('type', 'choice', array(
                'choices' => UserComment::getTypeColumns()
            ))
            ->add('state', 'choice', array(
                'choices' => UserComment::getStateList()
            ));
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('type')
            ->add('text')
            ->add('state');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('type', 'choice', array(
                'choices' => UserComment::getTypeColumns()
            ))
            ->add('text')
            ->add('state', 'choice', array(
                'choices' => UserComment::getStateList()
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
            //      'view' => array(),
                    'edit' => array(),
                    'delete' => array()
                )
            ));
    }
}