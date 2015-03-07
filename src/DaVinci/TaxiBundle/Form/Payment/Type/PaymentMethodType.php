<?php

namespace DaVinci\TaxiBundle\Form\Payment\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use DaVinci\TaxiBundle\Form\Payment\MakePayment;
use DaVinci\TaxiBundle\Form\Payment\CreditCardPaymentMethod;

class PaymentMethodType extends AbstractType 
{
	
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder
			->add('balanceType', 'choice', array(
				'choices' => MakePayment::getBalanceTypes()
			))
			->add('creditCardMethods', 'choice', array(
				'choices' => CreditCardPaymentMethod::getCardTypes(),
				'mapped' => false	
			))
			->add('otherMethods', 'choice', array(
				'choices' => array(
					'paypal' => 'PayPal',
					'skrill' => 'Skrill'	
				),
				'mapped' => false	
			))
			->add('price', 'hidden', array(
				'mapped' => false
			));
	}
	
	public function getName() 
	{
		return 'makePaymentStepMethod';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) 
	{
		$resolver->setDefaults(array(
			'data_class' =>	'DaVinci\TaxiBundle\Form\Payment\MakePayment',
			'validation_groups' => array('flow_makePayment_step1'),
			'csrf_protection' => false
		));
	}
	
}

?>