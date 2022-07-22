<?php

namespace App\Form;

use App\Entity\ItemState;
use App\Entity\Rf;
use Doctrine\DBAL\Types\DateType as TypesDateType;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\TimeTrait;

class RfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('owning_date',DateType::class,[
                'label'=>"date d'entrée",
                'widget'=>'single_text',
                
            ])
            ->add('created_at')
            ->add('update_at')
            ->add('model')
            ->add('serial_number')
            ->add('state')
            ->add('Valider',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rf::class,
        ]);
    }
}
