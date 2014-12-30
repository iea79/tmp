<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DaVinci\TaxiBundle\Entity\Vehicle;
use DaVinci\TaxiBundle\Entity\Admin\VehicleModelYear;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class DriverVehicleType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('year', 'choice', array(
                    'choices' => VehicleModelYear::getYearsLst(),
                    'empty_value' => 'form.please_select',
                    'translation_domain' => 'FOSUserBundle'
                ))
                ->add('make', 'choice', array(
                    'choices' => VehicleModelYear::getMakerList(),
                    'empty_value' => 'form.please_select',
                    'translation_domain' => 'FOSUserBundle'
                ))
                /*  ->add('model', 'choice', array(
                  'empty_value' => 'form.select_maker_first',
                  'translation_domain' => 'FOSUserBundle'
                  )) */
                ->add('color', 'choice', array(
                    'choices' => VehicleModelYear::getColorsList(),
                    'empty_value' => 'form.please_select',
                    'translation_domain' => 'FOSUserBundle'
                ))
                ->add('plate')
                ->add('vehicleClass', 'choice', array(
                    'choices' => Vehicle::getChoices(),
                    'empty_value' => 'form.please_select',
                    'translation_domain' => 'FOSUserBundle'
                ))
                ->add('seats', 'choice', array(
                    'choices' => VehicleModelYear::getSeatsList()
                ))
                ->add('luggages', 'choice', array(
                    'choices' => VehicleModelYear::getLuggageList()
                ))
                ->add('doors', 'choice', array(
                    'choices' => VehicleModelYear::getDoorsList()
                ))
                ->add('photo', 'file', array('required' => false, 'data_class' => null))
                ->add('about', 'textarea', array(
                    'required' => false
                ))
        ;

        
        
        $listener = function (FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();

            $make = $model = NULL;

            if (isset($data)) {
                if ($data instanceof \DaVinci\TaxiBundle\Entity\DriverVehicle) {
                    $model = $data->getModel();
                    $make = $data->getMake();
                } else {
                    $make = $data['make'];
                    $model = isset($data['model']) ? $data['model'] : NULL;
                }
            } 
            
           // var_dump($model,$make);
            if ($form->has('model'))
                $form->remove('model');

            //\Doctrine\Common\Util\Debug::dump($make);
            $form->add('model', 'entity', array(
                'class' => 'DaVinciTaxiBundle:Admin\VehicleModelYear',
                'empty_value' => ($make == NULL) ? 'form.select_maker_first' : 'form.please_select',
                'translation_domain' => 'FOSUserBundle',
                'property' => 'model',
                'data' => $model,
                'query_builder' => function (EntityRepository $repository) use ($make) {
                    if($make==NULL) $make='';
                    
//                    var_dump($repository->createQueryBuilder('v')
//                            ->select('v.model')
//                            ->where("v.make = :make")
//                            ->setParameter('make', $make)->getQuery()->getSingleResult());
                    return $repository->createQueryBuilder('v')
                                    ->select('v')
                                    ->where("replace( LOWER(v.make) ,  ' ',  '' ) = :make")
                                    ->groupBy('v.model')
                                    ->setParameter('make', $make);
                }
            ));
        };
//add data to select
        $builder->addEventListener(FormEvents::PRE_SUBMIT, $listener);
        $builder->addEventListener(FormEvents::POST_SET_DATA, $listener);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'DaVinci\TaxiBundle\Entity\DriverVehicle'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'davinci_taxibundle_drivervehicle';
    }

}
