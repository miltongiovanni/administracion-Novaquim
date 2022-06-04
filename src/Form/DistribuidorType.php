<?php

namespace App\Form;

use App\Entity\Distribuidor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DistribuidorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('distribuidor')
            ->add('contacto')
            ->add('telefono')
            ->add('celular')
            ->add('direccion')
            ->add('longitud')
            ->add('latitud')
            ->add('estado')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Distribuidor::class,
        ]);
    }
}
