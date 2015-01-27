<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PassengerInfoType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('tariff', new TariffType())
			->add('passenger_detail', new PassengerDetailType());
	}
	
	public function getName() {
		return 'createPassengerRequestStep3';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' =>	'DaVinci\TaxiBundle\Entity\PassengerRequest',
			'csrf_protection' => false,
		));
	}
	
}

?>