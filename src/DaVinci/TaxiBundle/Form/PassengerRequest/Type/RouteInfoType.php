<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Time;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Valid;

class RouteInfoType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('route_points', 'collection', array(
				'type' => new RoutePointType(),
				'required' => false,	
				'allow_add'    => true,
				'error_bubbling' => false,
				'cascade_validation' => true
			))
			->add('round_trip', 'checkbox')
			->add('pickUpDate', 'date', array(
				'widget' => 'single_text', 
				'format' => 'MM/dd/yy',
				'required' => false
			))
			->add('pick_up_time', 'time', array(
				'widget' => 'choice',
				'required' => false
			))
			->add('return_date', 'date', array(
				'widget' => 'single_text', 
				'format' => 'MM/dd/yy',
				'required' => false
			))
			->add('return_time', 'time', array(
				'widget' => 'choice',
				'required' => false
			));
	}
	
	public function getName() {
		return 'createPassengerRequestStep1';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' =>	'DaVinci\TaxiBundle\Entity\PassengerRequest',
			'csrf_protection' => false,
		));
	}
	
}

?>