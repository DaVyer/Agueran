<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Prénom',
                ],
            ])
            ->add('nom', TextType::class, [
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Nom',
                ],
            ])
            ->add('telephone', TelType::class, [
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Téléphone',
                ],
            ])
            ->add('adresse', TextType::class, [
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Adresse',
                ],
            ])
            ->add('ville', TextType::class, [
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Ville',
                ],
            ])
            ->add('codePostal', TextType::class, [
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Code Postal',
                    'pattern' => '^(?:0[1-9]|[1-8]\d|9[0-8])\d{3}$',
                    'maxlength' => 6,
                ],
            ])
            ->add('pays', CountryType::class, [
                'empty_data' => '',
                'preferred_choices' => ['FR'],
                'attr' => [
                    'placeholder' => 'Pays',
                ],
            ])
            ->add('email', EmailType::class, [
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Email',
                ],
            ])
            ->add('password', PasswordType::class, [
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Mot de passe',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
