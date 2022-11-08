<?php

namespace App\Form;

use App\Entity\Link;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
            ])
            ->add('link', UrlType::class, [
                'required' => true,
                'default_protocol' => 'https'
            ])
            ->add('textColor', TextType::class, [
                'required' => false,
                'empty_data' => '#000000',
            ])
            ->add('backgroundColor', TextType::class, [
                'required' => false,
                'empty_data' => '#fcfcfc',
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Link::class,
        ]);
    }
}
