<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\CommentBundle\Admin\PHPCR;

use Sonata\AdminBundle\Admin\Admin as Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper as FormMapper; 

class FakeCommentAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('messageTrimmed')
            ->add('_action', 'actions', array(
                'actions' => array(
                   'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }
    
//    public function getNewInstance()
//    {
//        $documentManager = $this->getConfigurationPool()->getContainer()->get('doctrine_phpcr')->getManager();
//
//        $fakePath = $documentManager->find(null, '/cms/comments/fake');
//
//        $instance = parent::getNewInstance();
//        $instance->setParentDocument($fakePath);
//        
//        return $instance;
//    }
    
    
    protected function configureFormFields(FormMapper $formMapper)
    {
 
        $formMapper
           // ->with('Other',  array('collapsed' => true))
                ->add('authorName')
                ->add('message', 'textarea', array('label' => 'Message'))
                ->add('date')
                ->add('value','choice', array(
                    'choices' => \Application\Sonata\CommentBundle\PHPCR\FakeComment::getValueList()))
                ->add('parentDocument', 'doctrine_phpcr_odm_tree', array('mapped' => true, 'root_node' => '/cms/comments/fake', 'select_root_node' => '/cms/comments/fake', 'choice_list' => array(), 'select_root_node' => true))
           // ->end()
        ;
    }

}
