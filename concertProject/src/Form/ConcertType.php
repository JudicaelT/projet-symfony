<?php

namespace App\Form;

use App\Entity\Concert;
use App\Entity\Hall;
use App\Entity\Band;
use App\Entity\Organiser;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ConcertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('date_start', DateType::class,[
                'widget' => 'choice',
                'format' => 'dd / MM / yyyy',
                'attr' => array('class' => 'sf-form-select')
            ])
            ->add('date_end', DateType::class,[
                'widget' => 'choice',
                'format' => 'dd / MM / yyyy',
                'attr' => array('class' => 'sf-form-select'),
            ])
            ->add('name', TextType::class,[
                'attr' => array('class' => 'form-control'),
            ])
            ->add('logo', FileType::class,[
                'required' => false,
                'data_class' => null,
                'attr' => array('class' => 'form-control'),
            ])
            ->add('hall', EntityType::class,[
                'class' => Hall::class,
                'choice_label' => 'getFullAdress',
                'attr' => array('class' => 'form-control'),
            ])
            ->add('organiser', EntityType::class,[
                'class' => Organiser::class,
                'choice_label' => 'getFullName',
                'attr' => array('class' => 'form-control'),
            ])
            ->add('bands', EntityType::class,[
                'class' => Band::class,
                'choice_label' => 'name',
                'attr' => array('class' => 'form-control'),
                'multiple' => true
            ])
            ->add('save', SubmitType::class,[
                'attr' => array('class' => 'btn py-2 mt-4 w-100 bg-burple'),
                'label' => 'Create Concert'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Concert::class,
        ]);
    }
}
