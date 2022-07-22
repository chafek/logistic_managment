<?php

namespace App\Form;

use App\Entity\Rf;
use App\Entity\Cart;
use App\Entity\Login;
use App\Entity\Member;
use App\Entity\MyLogin;
use App\Entity\Service;
use App\Entity\HourWorktime;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName',TextType::class,[
                'label'=>'Prénom:'
            ])
            ->add('lastName',TextType::class,[
                'label'=>'Nom:'
            ])
           
            ->add('myLogin',EntityType::class,[
                'class'=>MyLogin::class,
                'expanded'=>false,
                'required'=>false,
                'label'=>'Login:'
            ])
            
            
            ->add('service',EntityType::class,[
                'class'=>Service::class,
                'expanded'=>false,
                'required'=>false,
                'label'=>'Service:'
            ])
            ->add('rf',EntityType::class,[
                'class'=>Rf::class,
                'expanded'=>false,
                'required'=>false,
                'label'=>'RF:'
            ])
            ->add('cart',EntityType::class,[
                'class'=>Cart::class,
                'expanded'=>false,
                'required'=>false,
                'label'=>'Chariot:'
            ])
            ->add('worktime',EntityType::class,[
                'class'=>HourWorktime::class,
                'expanded'=>false,
                'required'=>false,
                'label'=>'Horaires:'
            ])
            ->add('created_at')
            ->add('update_at')
            ->add("sauvegarder",SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
