<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DaVinci\TaxiBundle\Entity\VehicleChildSeat;

class VehicleChildSeatType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('child_seat_number', 'integer')
			->add('child_seat_type', 'choice', array(
				'choices' => VehicleChildSeat::getChoices()
			));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' => 'DaVinci\TaxiBundle\Entity\VehicleChildSeat',
		));
	}
	
	public function getName() {
		return 'child_seat';
	}
	
}

?>