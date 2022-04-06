<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('backgroundColor', TextType::class, [
                'required' => true,
                'empty_data' => '#ffffff',
                'invalid_message' => 'Color must be set'
            ])
            ->add('textColor', TextType::class, [
                'required' => true,
                'empty_data' => '#000000',
                'invalid_message' => 'Color must be set'
            ])
            ->add('transitionFunction', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Choose an option...',
                'empty_data' => 'ease',
                'choices' => [
                    'ease' => 'ease',
                    'ease-in' => 'ease-in',
                    'ease-out' => 'ease-out',
                    'ease-in-out' => 'ease-in-out',
                    'linear' => 'linear',
                    'step-start' => 'step-start',
                    'step-end' => 'step-end'
                ],
            ])
            ->add('transitionDuration', NumberType::class, [
                'required' => false,
                'input' => 'number',
                'scale' => 2,
                'empty_data' => '0.75',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}