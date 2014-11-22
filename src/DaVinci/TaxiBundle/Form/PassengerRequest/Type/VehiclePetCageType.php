<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DaVinci\TaxiBundle\Entity\VehiclePetCage;

class VehiclePetCageType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('pet_cage_number', 'integer')
			->add('pet_cage_type', 'choice', array(
				'choices' => VehiclePetCage::getChoices()
			));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' => 'DaVinci\TaxiBundle\Entity\VehiclePetCage',
		));
	}
	
	public function getName() {
		return 'pet_cage';
	}
	
}

?>