<?php

namespace App\Form;

use App\Entity\Cita;
use App\Entity\Mecanico;
use App\Entity\Vehiculo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CitaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha')
            ->add('mecanico', EntityType::class,
                [
                    'class'=> Mecanico::class,
                    'choice_label'=>'lastname',
                ]
            )
            ->add('vehiculo',EntityType::class,
            [
                'class'=> Vehiculo::class,
                'choice_label'=>'modelo',
                'attr'=> array('class'=>'mr-2')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cita::class,
        ]);
    }
}
