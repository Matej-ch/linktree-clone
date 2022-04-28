<?php

namespace App\Form;

use App\Entity\Color;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ColorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('value', TextType::class, [
                'required' => true,
                'empty_data' => '#ffffff',
                'invalid_message' => 'Color must be set'
            ])
            ->add('text', TextType::class)
            ->add('textColor', TextType::class, [
                'required' => true,
                'empty_data' => '#000000',
            ])
            ->add('nameColor', TextType::class, [
                'required' => true,
                'empty_data' => '#000000',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Color::class,
        ]);
    }
}
