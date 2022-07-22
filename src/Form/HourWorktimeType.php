<?php

namespace App\Form;

use App\Entity\HourWorktime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class HourWorktimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start_hour', TimeType::class, [
                'input'=>'datetime',
                'widget'=>'choice',
                'html5'=>true
            ])
            ->add('end_hour', TimeType::class, [
                'input'=>'datetime',
                'widget'=>'choice'])
            ->add('created_at')
            ->add('update_at')
            ->add('valider', SubmitType::class, [
                'attr'=>["color"=>"red"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HourWorktime::class,
        ]);
    }
}
