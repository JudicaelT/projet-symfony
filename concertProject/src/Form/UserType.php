<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class,[
                'attr' => array('class' => 'form-control'),
            ])
            ->add('password', PasswordType::class,[
                'attr' => array('class' => 'form-control'),
            ])
            ->add('firstName', TextType::class,[
                'attr' => array('class' => 'form-control'),
            ])
            ->add('lastName', TextType::class,[
                'attr' => array('class' => 'form-control'),
            ])
            ->add('save', SubmitType::class,[
                'attr' => array('class' => 'btn py-2 mt-4 w-100 bg-burple'),
                'label' => 'Update profile'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
