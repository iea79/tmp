<?php

namespace DaVinci\UserBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;
use Symfony\Component\Form\FormTypeInterface;

class CreateCompanyDriverFlow extends FormFlow {

    /**
     * @var FormTypeInterface
     */
    protected $formType;

    public function setFormType(FormTypeInterface $formType) {
        $this->formType = $formType;
    }

    public function getName() {
        return 'taxi_company_driver_registration';
    }

    //registration steps
    protected function loadStepsConfig() {
        return array(
            array(
                'label' => 'form.register.companydriver',
                'type' => $this->formType,
            ),
            array(
                'label' => 'form.register.check',
                'type' => $this->formType,
            )
        );
    }
}
