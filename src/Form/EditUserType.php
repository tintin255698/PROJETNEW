<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,  ['attr'=>['placeholder'=>'Merci de saisir une adresse email']])
            ->add('roles', ChoiceType::class, [
                'choices'  =>
                    [
                        'Administrateur'=>'ROLE_ADMIN',
                        'Utilisateur'=>'ROLE_USER'
                    ],
                'expanded' => true,
                'multiple' => true,

                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
