<?php

namespace App\Form;

use App\Entity\Alumne;
use App\Entity\Cicle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlumneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('cognom')
            ->add('telefon')
            ->add('direccio')
            ->add('observacions',TextareaType::class)
            ->add('cicle')
            ->add('professor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Alumne::class,
        ]);
    }
}
