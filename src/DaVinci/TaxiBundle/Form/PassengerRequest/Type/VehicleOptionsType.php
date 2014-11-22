<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VehicleOptionsType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('child_seats', 'collection', array('type' => new VehicleChildSeatType()))
			->add('pet_cages', 'collection', array('type' => new VehiclePetCageType()))
			->add('cycle_rack', 'integer')
			->add('ski_rack', 'integer')
			->add('stroller_place', 'integer')
			->add('wheel_chair_place', 'integer')
			->add('roof_rack', 'checkbox')
			->add('trailer', 'checkbox');
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' => 'DaVinci\TaxiBundle\Entity\VehicleOptions',
		));
	}
	
	public function getName() {
		return 'vehicle_options';
	}
	
}

?>