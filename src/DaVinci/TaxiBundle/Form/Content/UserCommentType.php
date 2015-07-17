<?php

namespace DaVinci\TaxiBundle\Form\Content;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use DaVinci\TaxiBundle\Entity\UserComment;

class UserCommentType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) 
    {
		$builder
            ->add('rateLevel', 'choice', array(
                'choices' => UserComment::getRateList()
            ))
            ->add('text', 'textarea');
	}
	
	public function configureOptions(OptionsResolver $resolver) 
    {
		$resolver->setDefaults(array(
			'data_class' => 'DaVinci\TaxiBundle\Entity\UserComment',
            'validation_groups' => array('user_comment'),
            'csrf_protection' => false
		));
	}
	
	public function getName() {
		return 'userComment';
	}
	
}
