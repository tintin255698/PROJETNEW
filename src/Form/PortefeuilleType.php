<?php

namespace App\Form;

use App\Entity\Portefeuille;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PortefeuilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [ 'attr'=>['placeholder'=>'Nom du portefeuille']])
            ->add('placements', CollectionType::class,
            [
                'entry_type' => PlacementType::class,
                'entry_options' => ['label' => false],
                'prototype'=>true,
                'allow_add'=>true

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Portefeuille::class,
        ]);
    }
}
