<?php

namespace App\Form;

use App\Entity\Reserver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReserverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbVisiteurs', IntegerType::class, [
                'label' => false,
                'attr' => [
                    'min' => 0,
                    'max' => $options['max'],
                    'step' => 1,
                    'value' => 0,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reserver::class,
            'max' => 0,
        ]);

        $resolver->setAllowedTypes('max', 'int');
    }
}
