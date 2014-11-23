<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VehicleServicesType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('wifi', 'checkbox')
			->add('gps', 'checkbox')
			->add('air_conditioner', 'checkbox')
			->add('sun_roof', 'checkbox')
			->add('non_smokers', 'checkbox')
			->add('first_aid_kit', 'checkbox')
			->add('cool_drinks', 'textarea', array('required' => false))
			->add('snacks', 'textarea', array('required' => false))
			->add('dvd', 'textarea', array('required' => false))
			->add('gadgets', 'textarea', array('required' => false))
			->add('tools_for_disabled', 'textarea', array('required' => false))
			->add('disease', 'textarea', array('required' => false));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' => 'DaVinci\TaxiBundle\Entity\VehicleServices',
		));
	}
	
	public function getName() {
		return 'vehicle_services';
	}
	
}

?>