<?php

namespace DaVinci\TaxiBundle\Admin;

use Symfony\Cmf\Bundle\ContentBundle\Admin\StaticContentAdmin;
use Sonata\AdminBundle\Form\FormMapper;

class ProfitPageAdmin extends StaticContentAdmin
{

    public function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
        $formMapper
                ->with('form.group_genearal')
                ->add('somestring')
                ->end();
    }
}