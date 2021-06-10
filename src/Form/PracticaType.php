<?php

namespace App\Form;

use App\Entity\Alumne;
use App\Entity\Empresa;
use App\Entity\Practica;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PracticaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('periode',  ChoiceType::class, [
                'choices' => [
                    'Febrer - Juny' => 'Febrer - Juny',
                    'Setembre - Febrer' => 'Setembre - Febrer',
                ],
            ])
            ->add('data', DateTimeType::class, [
                'label' => 'Data',
                'widget' => 'single_text',

            ])
            ->add('observacions',TextareaType::class)
            ->add('alumne', EntityType::class,
                ['class' => Alumne::class,
                    'choice_label' => 'nom',
                    'placeholder' => 'Tria un alumne',
                ])
            ->add('empresa', EntityType::class,
                ['class' => Empresa::class,
                    'choice_label' => 'nom',
                    'placeholder' => 'Tria una empresa',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Practica::class,
        ]);
    }
}
