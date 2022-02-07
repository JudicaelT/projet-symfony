<?php

namespace App\Form;

use App\Entity\Member;
use App\Entity\Band;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class,[
                'attr' => array('class' => 'form-control'),
            ])
            ->add('last_name', TextType::class,[
                'attr' => array('class' => 'form-control'),
            ])
            ->add('pseudo', TextType::class,[
                'required' => false,
                'attr' => array('class' => 'form-control'),
            ])
            ->add('birthDate', DateType::class,[
                'widget' => 'choice',
                'format' => 'dd / MM / yyyy',
                'years' => range(date('Y')-100, date('Y')),
                'months' => range(date('m'), 12),
                'days' => range(date('d'), 31),
                'attr' => array('class' => 'sf-form-select')
            ])
            ->add('role', TextType::class,[
                'attr' => array('class' => 'form-control'),
            ])
            ->add('picture', FileType::class,[
                'required' => false,
                'data_class' => null,
                'attr' => array('class' => 'form-control'),
            ])
            ->add('band', EntityType::class,[
                'class' => Band::class,
                'choice_label' => 'name',
                'attr' => array('class' => 'form-control')
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
            'data_class' => Member::class,
        ]);
    }
}
