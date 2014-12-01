<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DaVinci\UserBundle\Form\EventListener\AddCityFieldSubscriber;
use Doctrine\ORM\EntityRepository;

class AddressType extends AbstractType
{
    
    /**
     * @var ObjectManager
     */
    private $om;
    
    private $with_street;
    public function __construct($with_street = true, ObjectManager $om = null)
    {
        $this->with_street = $with_street;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $propertyPathToCity = 'city';

        $builder
            ->add('country', 'entity', array(
                            'class' => 'DaVinci\TaxiBundle\Entity\Admin\CountryCity',
                            'property' => 'country',
                            'empty_value' => 'form.please_select',
                            'translation_domain' => 'FOSUserBundle',
                            'property_path' => 'country',
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('c')->select('c')->where('c.status = 1' )->groupBy('c.countryCode')->orderBy('c.countryCode', 'ASC');
                            }))
            ->addEventSubscriber(new AddCityFieldSubscriber($propertyPathToCity));
        if($this->with_street)
            $builder->add('street', 'text');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DaVinci\TaxiBundle\Entity\Address',
        ));
    }

    public function getName()
    {
        return 'address';
    }

    function getIdentifier()
    {
        return 'address';
    }
}
