<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DaVinci\UserBundle\Form\EventListener\AddCityFieldSubscriber;
use Doctrine\ORM\EntityRepository;

class LanguageType extends AbstractType
{
    private $with_level;
    public function __construct($with_level = true) {
        $this->with_level = $with_level;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('level', 'choice', array(
                            'choices' => \DaVinci\TaxiBundle\Entity\Language::getLanguageLevelOptions(),
                            'empty_value' => 'form.please_select',
                            'label' => 'form.english',
                            'translation_domain' => 'FOSUserBundle'
                        ))
            ->add('languages', 'collection', array(
                    'type'         => 'language',
                    'options'      =>array(
                    'empty_value' => 'form.please_select'),
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'translation_domain' => 'FOSUserBundle'
                ));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DaVinci\TaxiBundle\Entity\Language',
        ));
    }

    public function getName()
    {
        return 'language';
    }

    function getIdentifier()
    {
        return 'language';
    }
}

