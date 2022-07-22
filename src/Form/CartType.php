<?php

namespace App\Form;

use App\Entity\Cart;
use App\Entity\Service;
use App\Entity\ItemState;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType as TypeDateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('internal_number',TextType::class,[
                'label'=>'Numéro interne:'
            ])
            ->add('mark',TextType::class,[
                'label'=>'Marque:'
            ])
            ->add('serial_number',TextType::class,[
                'label'=>'Numéro de série:'
            ])
            ->add('type',TextType::class,[
                'label'=>'Type:'
            ])
            ->add('rent_date_start',TypeDateType::class,[
                'widget'=>'single_text',
                'label'=>'Date début location:'
            ])
            ->add('rent_date_end',TypeDateType::class,[
                'widget'=>'single_text',
                'label'=>'Date fin location:'
            ])
            ->add('model',TextType::class,[
                'label'=>'modèle:'
            ])
            ->add('state',EntityType::class,[
                'label'=>'Etat:',
                'class'=>ItemState::class
                
            ])
            ->add('service',EntityType::class,[
                'class'=>Service::class,
                'expanded'=>false,
                'required'=>false,
                'placeholder'=>"Sélectionnez le service ",
                'label'=>'Service:'
            ])
            ->add('Valider',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cart::class,
        ]);
    }
}
