<?php

namespace DaVinci\UserBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;
use Symfony\Component\Form\FormTypeInterface;

class CreateManagerFlow extends FormFlow {

    /**
     * @var FormTypeInterface
     */
    protected $formType;

    public function setFormType(FormTypeInterface $formType) {
        $this->formType = $formType;
    }

    public function getName() {
        return 'taxi_manager_registration';
    }

    //registration steps
    protected function loadStepsConfig() {
        return array(
            array(
                'label' => 'form.register.company',
                'type' => $this->formType,
            ),
            array(
                'label' => 'form.register.check',
                'type' => $this->formType,
            )
        );
    }
}
