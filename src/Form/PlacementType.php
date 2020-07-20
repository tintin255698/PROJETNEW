<?php

namespace App\Form;

use App\Entity\Placement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlacementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('produits', ChoiceType::class, [
                'choices'  =>
                    [
                        'Selectionner votre cryptomonnaie'=>'Selectionner votre cryptomonnaie',
                        'Bitcoin'=>'Bitcoin',
                        'Chainlink'=>'Chainlink',
                        'Ethereum'=>'Ethereum',
                        'Cardano'=>'Cardano',
                        'Tezos'=>'Tezos'
                    ]])
            ->add('quantite', IntegerType::class, [
                'attr' =>[
                    'placeholder'=>"Quantite de produits achetes"
                ]
            ])
            ->add('prix', MoneyType::class, [
                'attr' =>[
                    'placeholder'=>"Prix a l'unite"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Placement::class,
        ]);
    }
}
