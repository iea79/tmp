<?php

namespace DaVinci\TaxiBundle\Form\Payment\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use DaVinci\TaxiBundle\Entity\Payment\MakePayment;

class SkrillPaymentInfoType extends AbstractType 
{
	
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder
			->add('paymentMethodCode', 'hidden')
			->add('price', 'number', array(
				'mapped' => false
			))
			->add('paymentMethod', new SkrillType());
	}
	
	public function getName() 
	{
		return 'makePaymentStepPaymentInfo';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) 
	{
		$resolver->setDefaults(array(
			'data_class' =>	'DaVinci\TaxiBundle\Entity\Payment\MakePayment',
			'validation_groups' => array('flow_makePayment_step2'),
			'csrf_protection' => false
		));
	}
	
}

?>