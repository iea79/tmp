<?php

namespace DaVinci\TaxiBundle\Form\Payment\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use DaVinci\TaxiBundle\Entity\Payment\PaymentMethod;
use DaVinci\TaxiBundle\Entity\Payment\CreditCardPaymentMethod;

class CreditCardType extends AbstractType 
{
	
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder
			->add('firstname', 'text')
			->add('lastname', 'text')
			->add('cardNumber', 'text')
			->add('secretSalt', 'text')
			->add('expirationMonth', 'choice', array(
				'choices' => $this->generateMonth()
			))
			->add('expirationYear', 'choice', array(
				'choices' => $this->generateYear()
			))
			->add('company', 'text')
			->add('address', 'text')
			->add('city', 'text')
			->add('state', 'text')
			->add('country', 'text')
			->add('ownNote', 'text');
	}
	
	public function getName() 
	{
		return 'creditCardPaymentInfo';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) 
	{
		$resolver->setDefaults(array(
			'data_class' =>	'DaVinci\TaxiBundle\Entity\Payment\CreditCardPaymentMethod',
			'validation_groups' => array('flow_makePayment_step2'),
			'csrf_protection' => false
		));
	}
	
	private function generateMonth()
	{
		$result = array();
		$begin = new \DateTime('2015-01-01');
		
		$count = 0;
		while ($count < 12) {
			$result[$begin->format('m')] = $begin->format('m');
			$begin->modify('+1 month');
			
			$count++;
		} 
		
		return $result;
	}
	
	private function generateYear()
	{
		$result = array();
		$current = new \DateTime('now');
	
		$count = 0;
		while ($count < PaymentMethod::MAX_YEAR_PERIOD) {
			$result[$current->format('y')] = $current->format('Y');
			$current->modify('+1 year');
			
			
			$count++;
		}
	
		return $result;
	}
	
}

?>