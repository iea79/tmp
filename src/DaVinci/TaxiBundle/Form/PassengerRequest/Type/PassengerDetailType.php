<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PassengerDetailType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('adult', 'number')
			->add('children', 'number')
			->add('seniors', 'number')
			->add('my_self', 'checkbox')
			->add('name', 'text')
			->add('email', 'text')
			->add('skype', 'text')
			->add('mobile_code', 'integer')
			->add('mobile_code', 'integer')
			->add('mobile_has_wifi', 'checkbox')
			->add('mobile_has_whatsapp', 'checkbox')
			->add('about', 'text');
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' => 'DaVinci\TaxiBundle\Entity\PassengerDetail'
		));
	}
	
	public function getName() {
		return 'passenger_detail_type';
	}
	
}

?>