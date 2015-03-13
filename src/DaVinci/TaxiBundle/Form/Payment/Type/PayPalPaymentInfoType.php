<?php

namespace DaVinci\TaxiBundle\Form\Payment\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PayPalPaymentInfoType extends AbstractType 
{
	
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder
			->add('paymentMethod', new PayPalType());
	}
	
	public function getName() 
	{
		return 'makePaymentStepPayPalPaymentInfo';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) 
	{
		$resolver->setDefaults(array(
			'data_class' =>	'DaVinci\TaxiBundle\Form\Payment\MakePayment',
			'validation_groups' => array('flow_makePayment_step2'),
			'csrf_protection' => false
		));
	}
	
}

?>