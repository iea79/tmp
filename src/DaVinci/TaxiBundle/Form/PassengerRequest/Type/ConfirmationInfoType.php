<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ConfirmationInfoType extends AbstractType 
{
        
    const EDIT_PASSENGER_REQUEST_PARAM = 'edit_passenger_request';
    
    const CONFIRM_PASSENGER_REQUEST = 0;
        
    const EDIT_PASSENGER_REQUEST_INITIALIZE = 1;
    const EDIT_PASSENGER_REQUEST_CONFIRM = 2;
    
	public function buildForm(FormBuilderInterface $builder, array $options) 
    {
		$builder
            ->add(self::EDIT_PASSENGER_REQUEST_PARAM, 'hidden', array(
                'mapped' => false,
                'data' => self::CONFIRM_PASSENGER_REQUEST
            ));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
		$resolver->setDefaults(array(
			'data_class' =>	'DaVinci\TaxiBundle\Entity\PassengerRequest',
			'csrf_protection' => false
		));
	}
	
	public function getName() 
    {
		return 'confirmationInfo';
	}
	
}

?>