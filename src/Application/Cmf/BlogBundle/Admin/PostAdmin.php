<?php


namespace Application\Cmf\BlogBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Cmf\Bundle\BlogBundle\Admin\PostAdmin as Admin;


class PostAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('dashboard.label_post')
                ->add('title')
                ->add('date', 'sonata_type_datetime_picker')
                ->add('bodyPreview', 'textarea')
                ->add('body', 'ckeditor',array('label' => 'Text block'))
                ->add('blog', 'phpcr_document', array(
                    'class' => $this->blogClass,
                ))
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('title', 'doctrine_phpcr_string')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('blog')
            ->add('date', 'datetime')
        ;
    }
}
