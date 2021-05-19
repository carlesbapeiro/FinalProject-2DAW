<?php

namespace App\Form;

use App\Entity\Empresa;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cif')
            ->add('nom', TextType::class, [

                'label'=>'Nom',
                'required'=>true,
                'attr'=>[
                    'placeholder' => 'Nom',
                    'class'=>'form-control shadow-none'
                ],
            ])
            ->add('telefon', NumberType::class,
                [
                    'label'=>'Telefon',
                    'required'=>true,
                    'attr'=>[
                        'placeholder' => 'Telefon',
                        'class'=>'form-control shadow-none'
                    ],
                ])
            ->add('mail',EmailType::class,[

                'label'=>'Email',
                'required'=>true,
                'attr'=>[
                    'placeholder' => 'Email',
                    'class'=>'form-control shadow-none'
                ],

            ])
            ->add('adresa', TextType::class, [

                'label'=>'Adreça',
                'required'=>true,
                'attr'=>[
                    'placeholder' => 'Adreça',
                    'class'=>'form-control shadow-none'
                ],
            ])
            ->add('hora_entrada', TimeType::class,[

                'widget' => 'single_text'
            ])
            ->add('hora_eixida', TimeType::class,[

                'widget' => 'single_text'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Empresa::class,
        ]);
    }
}
