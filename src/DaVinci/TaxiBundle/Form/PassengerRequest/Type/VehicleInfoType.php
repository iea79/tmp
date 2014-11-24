<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VehicleInfoType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('vehicle', new VehicleType())
			->add('vehicle_options', new VehicleOptionsType())
			->add('vehicle_services', new VehicleServicesType())
			->add('vehicle_driver_conditions', new VehicleDriverConditionsType());
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'csrf_protection' => false,
		));
	}
	
	public function getName() {
		return 'vehicle_info';
	}
	
}

?>