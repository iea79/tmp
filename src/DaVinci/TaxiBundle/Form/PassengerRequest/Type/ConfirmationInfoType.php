<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ConfirmationInfoType extends AbstractType 
{
        
    const EDIT_PASSENGER_REQUEST_PARAM = 'edit_passenger_request';
    
    const EDIT_PASSENGER_REQUEST_INITIALIZE = 1;
    const EDIT_PASSENGER_REQUEST_CONFIRM = 2;
	
	public function buildForm(FormBuilderInterface $builder, array $options) 
    {
		$builder
            ->add(self::EDIT_PASSENGER_REQUEST_PARAM, 'hidden', array(
                'mapped' => false
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
		return 'confirmationInfo';
	}
	
}

?>