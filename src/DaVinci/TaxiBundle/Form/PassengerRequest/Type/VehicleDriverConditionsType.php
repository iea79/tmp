<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Intl\Intl;

class VehicleDriverConditionsType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('interpreter_lang', 'choice', array(
				'choices' => Intl::getLanguageBundle()->getLanguageNames(),	
				'required' => false
			))
			->add('educator', 'checkbox', array('required' => false))
			->add('medical_license', 'checkbox', array('required' => false))
			->add('body_guard', 'checkbox', array('required' => false))
			->add('animal_trainer', 'checkbox', array('required' => false))
			->add('carrier', 'checkbox', array('required' => false))
			->add('guide', 'checkbox', array('required' => false));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' => 'DaVinci\TaxiBundle\Entity\VehicleDriverConditions',
		));
	}
	
	public function getName() {
		return 'vehicleDriverConditions';
	}
	
}

?>