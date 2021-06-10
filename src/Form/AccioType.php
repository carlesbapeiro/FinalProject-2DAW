<?php

namespace App\Form;

use App\Entity\Accio;
use App\Entity\Practica;
use App\Entity\Professor;
use App\Entity\Representant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titol')
            ->add('cos',TextareaType::class)
            ->add('data',DateTimeType::class, [
                'label' => 'Data',
                'widget' => 'single_text',
                'by_reference' => true,

            ])
            ->add('professor', EntityType::class,
                ['class' => Professor::class,
                    'choice_label' => function ($professor) {
                        return $professor->getNom() . ' ' . $professor->getCognom();},
                    'placeholder' => 'Tria un professor',
                ])
            ->add('representant', EntityType::class,
                ['class' => Representant::class,
                    'choice_label' =>  function ($representant) {
                        return $representant->getNom() . ' ' . $representant->getCognom();},
                    'placeholder' => 'Tria un representant',
                ])
            ->add('practica', EntityType::class,
                ['class' => Practica::class,
                    'choice_label' => function ($practica) {
                        return $practica->getAlumne()->getNom() . ' ' . $practica->getAlumne()->getCognom() . ' - ' . $practica->getEmpresa()->getNom();
                    },
                    'placeholder' => 'Tria una practica',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accio::class,
        ]);
    }
}
