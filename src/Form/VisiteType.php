<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ville', TextType::class, [
                "label" => "ville",
                "disabled" => true,
            ])

            ->add('idVille', TextType::class, [
                "label" => "idVille"
            ])

            ->add('remarque', TextType::class, [
                "label" => "remarque",
                "required" => false,
                "mapped" => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
