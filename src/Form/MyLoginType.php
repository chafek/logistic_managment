<?php

namespace App\Form;

use App\Entity\MyLogin;
use App\Entity\Member;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyLoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference',TextType::class,[
                'label'=>'Login',
                'attr'=>[
                    'placeholder'=>'Ajouter un login',
                
           
                ]
            ])
            // ->add('member',EntityType::class,[
            //     'class'=>Member::class,
            //     'expanded'=>true
            // ])
            ->add('created_at')
            ->add('update_at')
            ->add('valider', SubmitType::class,[
                'attr'=>["color"=>"red"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MyLogin::class,
        ]);
    }
}
