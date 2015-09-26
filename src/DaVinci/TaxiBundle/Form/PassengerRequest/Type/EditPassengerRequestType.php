<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditPassengerRequestType extends AbstractType 
{
    	
	public function buildForm(FormBuilderInterface $builder, array $options) 
    {
		$builder
            ->add('distance', 'hidden')
			->add('duration', 'hidden')
			->add('routePoints', 'collection', array(
				'type' => new RoutePointType(),
				'error_bubbling' => false,
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'cascade_validation' => true
			))
			->add('roundTrip', 'checkbox')
			->add('pickUpDate', 'date', array(
				'widget' => 'single_text',
				'format' => 'dd.MM.yy',
				'required' => false
			))
			->add('pickUpTime', 'time', array(
				'widget' => 'choice',
				'required' => false
			))
			->add('returnDate', 'date', array(
				'widget' => 'single_text', 
				'format' => 'dd.MM.yy',
				'required' => false
			))
			->add('returnTime', 'time', array(
				'widget' => 'choice',
				'required' => false
			))
            ->add('vehicle', new VehicleType())
			->add('vehicle_options', new VehicleOptionsType())
			->add('vehicle_services', new VehicleServicesType())
			->add('vehicle_driver_conditions', new VehicleDriverConditionsType())
            ->add('tariff', new TariffType())
			->add('passenger_detail', new PassengerDetailType())
            ->add(ConfirmationInfoType::EDIT_PASSENGER_REQUEST_PARAM, 'hidden', array(
                'mapped' => false,
                'data' => ConfirmationInfoType::EDIT_PASSENGER_REQUEST_CONFIRM
            ));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
		$resolver->setDefaults(array(
			'data_class' =>	'DaVinci\TaxiBundle\Entity\PassengerRequest',
			'validation_groups' => array('edit_passenger_request'),
			'csrf_protection' => false
		));
	}
	
	public function getName() 
    {
		return 'editPassengerRequest';
	}
	
}

?>