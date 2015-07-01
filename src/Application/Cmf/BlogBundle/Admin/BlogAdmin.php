<?php

namespace Application\Cmf\BlogBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Cmf\Bundle\BlogBundle\Admin\BlogAdmin as Admin;

class BlogAdmin extends Admin
{
/*
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('dashboard.label_blog')
                ->add('name', 'text')
                ->add('description', 'ckeditor', array('label' => 'Text block'))
                ->add('parentDocument', 'doctrine_phpcr_odm_tree', array(
                    'root_node' => $this->blogRoot,
                    'choice_list' => array(),
                    'select_root_node' => true,
                ))
                ->add('topPosts', 'phpcr_document', array(
                    'property' => 'title',
                    'class'    => 'Application\Cmf\BlogBundle\Document\Post',
                    'multiple' => true,
                    'label' => 'Top Posts',
                    'required' => false,
                    'choices' => $this->getSubject()->getPosts()
               ))
            ->end()
            ->with('Other',  array('collapsed' => true))
            	->add('locale')
			->end();
    }
*/
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('name', 'doctrine_phpcr_string');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('locale');
    }
}

?>