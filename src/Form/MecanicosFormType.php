<?php

namespace App\Form;

use App\Entity\Mecanico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MecanicosFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('lastname')
            ->add('DNI')
            ->add('address')
            ->add('salario')
            ->add('horas')
            ->add('Cod_Cita')
            ->add('Cod_Vehiculo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mecanico::class,
        ]);
    }
}
