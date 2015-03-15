<?php

namespace DaVinci\TaxiBundle\Form\Payment\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use DaVinci\TaxiBundle\Form\Payment\MakePayment;
use DaVinci\TaxiBundle\Form\Payment\MakePaymentService;

class PaymentMethodType extends AbstractType 
{
	
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder
			->add('paymentMethodCode', 'choice', array(
				'choices' => MakePaymentService::generateMethods()
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