<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DaVinci\TaxiBundle\Entity\Vehicle;

class VehicleType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('vehicle_class', 'choice', array(
				'choices' => Vehicle::getChoices()
			))
			->add('special_requirements', 'textarea', array('required' => false));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' => 'DaVinci\TaxiBundle\Entity\Vehicle',
		));
	}
	
	public function getName() {
		return 'vehicle_type';
	}
	
}

?>