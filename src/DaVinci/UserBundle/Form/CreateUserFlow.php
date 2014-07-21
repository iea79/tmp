<?php
namespace DaVinci\UserBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;
use Symfony\Component\Form\FormTypeInterface;

class CreateUserFlow extends FormFlow {

    /**
     * @var FormTypeInterface
     */
    protected $formType;

    public function setFormType(FormTypeInterface $formType) {
        $this->formType = $formType;
    }

    public function getName() {
        return 'taxi_user_registration';
    }

    //registration steps
    protected function loadStepsConfig() {
        return array(
            array(
                'label' => 'form.contactinfo',
                'type' => $this->formType,
            ),
            array(
                'label' => 'form.signininfo',
                'type' => $this->formType,
            ),
            array(
                'label' => 'form.generalinfo',
                'type' => $this->formType,
            ),
        );
    }
}