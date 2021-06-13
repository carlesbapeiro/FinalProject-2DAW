<?php

namespace App\Form;

use App\Entity\Empresa;
use App\Entity\Representant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Representant1Type extends AbstractType
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
            ->add('cognom',TextType::class, [

                'label'=>'Cognom',
                'required'=>true,
                'attr'=>[
                    'placeholder' => 'Cognom',
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

                ]

            )
            ->add('mail',EmailType::class,[

                'label'=>'Email',
                'required'=>true,
                'attr'=>[
                    'placeholder' => 'Email',
                    'class'=>'form-control shadow-none'
                ],

            ])
            /*->add('alta')*/

           /* ->add('boto', SubmitType::class,[
                'label'=>'Submit',
                'attr'=>[
                    'class'=>'form-control shadow-none'
                ],
            ]);*/

            ->add('poblacio',TextType::class, [

                'label'=>'Poblacio',
                'required'=>false,
                'attr'=>[
                    'placeholder' => 'Poblacio',
                    'class'=>'form-control shadow-none'
                ],
            ])
            ->add('empresa', EntityType::class,
                ['class' => Empresa::class,
                    'choice_label' => 'nom',
                    'placeholder' => 'Tria una empresa',
                    'required' =>true
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Representant::class,
        ]);
    }
}
