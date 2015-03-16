<?php

namespace DaVinci\TaxiBundle\Form\Payment\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PayPalType extends AbstractType 
{
	
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder
			->add('firstname', 'text')
			->add('lastname', 'text')
			->add('cardNumber', 'text')
			->add('secretSalt', 'text')
			->add('expirationMonth', 'text')
			->add('expirationYear', 'text')
			->add('company', 'text')
			->add('address', 'text')
			->add('city', 'text')
			->add('state', 'text')
			->add('country', 'text')
			->add('ownNote', 'text');
	}
	
	public function getName() 
	{
		return 'payPalPaymentInfo';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) 
	{
		$resolver->setDefaults(array(
			'data_class' =>	'DaVinci\TaxiBundle\Form\Payment\PayPalPaymentMethod',
			'validation_groups' => array('flow_makePayment_step2'),
			'csrf_protection' => false
		));
	}
	
}

?>