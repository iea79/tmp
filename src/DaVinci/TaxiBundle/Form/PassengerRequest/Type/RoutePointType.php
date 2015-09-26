<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoutePointType extends AbstractType 
{
	
	public function buildForm(FormBuilderInterface $builder, array $options) 
    {
		$builder->add('place', 'text', array(
			'required' => false,
			'trim' => true	
		));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
		$resolver->setDefaults(array(
			'data_class' => 'DaVinci\TaxiBundle\Entity\RoutePoint',
			'validation_groups' => array('flow_createPassengerRequest_step1')
		));
	}
	
	public function getName() 
    {
		return 'routePoint';
	}
	
}

?>