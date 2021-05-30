<?php

namespace App\Form;

use App\Entity\Alumne;
use App\Entity\Cicle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [

                'label'=>'Nom',
                'required'=>true,
                'attr'=>[
                    'placeholder' => 'Nom',
                    'class'=>'form-control shadow-none'
                ],
            ])
            ->add('alumnes', EntityType::class,[
                'class' =>Alumne::class,
                'multiple' => true,
                'choice_label' => 'nom',
                'by_reference' => false,
                'attr'=>[
                    'class'=>'form-control shadow-none'
                ],
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cicle::class,
        ]);
    }
}
