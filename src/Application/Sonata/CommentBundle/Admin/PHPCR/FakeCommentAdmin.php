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
					'delete' => array()
                )
            ));
    }
  
    protected function configureFormFields(FormMapper $formMapper)
    {
         $formMapper
 		 	->add('authorName', 'text', array('label' => 'Author name'))
            ->add('message', 'textarea', array('label' => 'Message'))
            ->add('date', 'datetime', array(
            	'label' => 'Publication date',
               	'date_format' => 'dd.MM.yy',
            ))
            ->add('value','choice', array(
            	'label' => 'Stars',	
              	'choices' => \Application\Sonata\CommentBundle\PHPCR\FakeComment::getValueList()
                ))
            ->add(
            	'parentDocument', 
               	'doctrine_phpcr_odm_tree', 
               	array(
	              	'mapped' => true, 
                	'root_node' => '/cms/comments/fake', 
                	'select_root_node' => '/cms/comments/fake', 
                	'choice_list' => array(), 
                	'select_root_node' => true,
               		'label' => 'Parent document'	
               	)
    		);
    }

}
