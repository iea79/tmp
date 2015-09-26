<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\MediaBundle\Admin\PHPCR;

use Sonata\MediaBundle\Admin\PHPCR\MediaAdmin as Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class MediaAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->add('name')
            ->add('_action', 'actions', array(
                'actions' => array(
                   'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }
    /**
     * @param  \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        // TODO disabled filter due to no attached service for filter types: string, checkbox
        $datagridMapper
            ->add('name')
            ->add('providerReference')
            ->add('enabled')
            ->add('context')
        ;
    }

}
