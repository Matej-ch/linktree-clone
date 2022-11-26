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
            ->add('name', TextType::class, [
            ])
            ->add('text', TextType::class, [
                'required' => false
            ])
            ->add('value', TextType::class, [
                'empty_data' => '#ffffff',
            ])
            ->add('textColor', TextType::class, [
                'empty_data' => '#000000',
                'required' => false
            ])
            ->add('nameColor', TextType::class, [
                'empty_data' => '#000000',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Color::class,
        ]);
    }
}
