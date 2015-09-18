<?php

namespace DaVinci\TaxiBundle\Form\Payment\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use DaVinci\TaxiBundle\Entity\Payment\SkrillPaymentMethod;

class SkrillType extends AbstractType 
{
	
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder
			->add('email', 'text')
			->add('subject', 'text')
			->add('note', 'text')
			->add('company', 'text')
			->add('ownNote', 'text');
	}
	
	public function getName() 
	{
		return 'skrillPaymentInfo';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) 
	{
		$resolver->setDefaults(array(
			'data_class' =>	'DaVinci\TaxiBundle\Entity\Payment\SkrillPaymentMethod',
			'validation_groups' => array('flow_makePayment_step2'),
			'csrf_protection' => false
		));
	}
	
}

?>