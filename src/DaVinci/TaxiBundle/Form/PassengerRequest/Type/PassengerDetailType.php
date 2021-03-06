<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DaVinci\TaxiBundle\Entity\PassengerDetail;

class PassengerDetailType extends AbstractType 
{
	
	public function buildForm(FormBuilderInterface $builder, array $options) 
    {
		$builder
			->add('adult', 'number', array('data' => 0))
			->add('children', 'number', array('data' => 0))
			->add('seniors', 'number', array('data' => 0))
			->add('picture', 'iphp_file', array('required' => true))
            ->add('not_my_self', 'checkbox')
			->add('name', 'text')
			->add('email', 'text')
			->add('skype', 'text')
			->add('mobile_code', 'integer', array('data' => 1))
			->add('mobile_phone', 'text')
			->add('mobile_has_wifi', 'checkbox')
			->add('mobile_has_whatsapp', 'checkbox')
			->add('about', 'textarea');
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
		$resolver->setDefaults(array(
			'data_class' => 'DaVinci\TaxiBundle\Entity\PassengerDetail'
		));
	}
	
	public function getName() 
    {
		return 'passengerDetail';
	}
	
}

?>