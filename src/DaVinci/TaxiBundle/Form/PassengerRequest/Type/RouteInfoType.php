<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RouteInfoType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('route_points', 'collection', array('type' => new RoutePointType()))
			->add('pick_up_date', 'date', array('widget' => 'single_text', 'format' => 'MM/dd/yy', 'mapped' => false))
			->add('pick_up_time', 'time', array('widget' => 'choice', 'mapped' => false))
			->add('round_trip', 'checkbox', array('mapped' => false))
			->add('return_date', 'date', array('widget' => 'single_text', 'format' => 'MM/dd/yy', 'mapped' => false))
			->add('return_time', 'time', array('widget' => 'choice', 'mapped' => false));
	}
	
	public function getName() {
		return 'route_info';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'csrf_protection' => false,
		));
	}
	
}

?>