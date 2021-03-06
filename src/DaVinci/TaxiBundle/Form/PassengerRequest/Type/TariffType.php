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
				'choices' => Tariff::getTypes(),
				'data' => Tariff::POS_PRICE_TYPE_YOUR
			))
			->add('your_price', 'money')
			->add('market_price', 'hidden')
			->add('tips_type', 'choice', array(
				'choices' => Tariff::getTypes(),
				'data' => Tariff::POS_PRICE_TYPE_YOUR	
			))
			->add('your_tips', 'money')
			->add('market_tips', 'hidden')
			->add('price_payment_method', 'choice', array(
				'choices' => Tariff::getPaymentMethods(),
				'data' => Tariff::POS_PAYMENT_METHOD_ESCROW
			))
			->add('tips_payment_method', 'choice', array(
				'choices' => Tariff::getPaymentMethods(),
				'data' => Tariff::POS_PAYMENT_METHOD_ESCROW
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