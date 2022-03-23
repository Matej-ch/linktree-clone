<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('backgroundColor', \Symfony\Component\Form\Extension\Core\Type\ColorType::class, [
                'required' => true,
                'empty_data' => '#ffffff',
                'invalid_message' => 'Color must be in hexadecimal format'
            ])
            ->add('textColor', \Symfony\Component\Form\Extension\Core\Type\ColorType::class, [
                'required' => true,
                'empty_data' => '#000000',
                'invalid_message' => 'Color must be in hexadecimal format'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}