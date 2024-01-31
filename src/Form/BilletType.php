<?php

namespace App\Form;

use App\Entity\Billet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BilletType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateReservation', DateType::class, [
                'mapped' => false,
                'label' => false,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'min' => date('Y-m-d'),
                    'max' => date('Y-m-d', strtotime('+1 year')),
                    'value' => date('Y-m-d'),
                ],
            ])
            ->add('quantity20', IntegerType::class, [
                'mapped' => false,
                'label' => false,
                'attr' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                    'value' => 0,
                    'data-price' => 20,
                    'data-type' => 'Plein tarif',
                ],
            ])
            ->add('quantity15', IntegerType::class, [
                'mapped' => false,
                'label' => false,
                'attr' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                    'value' => 0,
                    'data-price' => 15,
                    'data-type' => 'Tarif réduit',
                ],
            ])
            ->add('quantity5', IntegerType::class, [
                'mapped' => false,
                'label' => false,
                'attr' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                    'value' => 0,
                    'data-price' => 5,
                    'data-type' => 'Moins de 10 ans',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Billet::class,
        ]);
    }
}
