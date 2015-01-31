<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use \DaVinci\TaxiBundle\Entity\Tariff;

class TariffType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('price_type', 'choice', array(
				'mapped' => false,
				'choices' => Tariff::getPriceTypes()	
			))
			->add('your_price', 'money', array('mapped' => false))
			->add('tips_type', 'choice', array(
				'mapped' => false,
				'choices' => Tariff::getTipsTypes()
			))
			->add('your_tips', 'money', array('mapped' => false))
			->add('price_payment_method', 'choice', array(
				'choices' => Tariff::getPaymentMethods()
			))
			->add('tips_payment_method', 'choice', array(
				'choices' => Tariff::getPaymentMethods()
			));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' => 'DaVinci\TaxiBundle\Entity\Tariff'
		));
	}
	
	public function getName() {
		return 'tariff';
	}
	
}

?>