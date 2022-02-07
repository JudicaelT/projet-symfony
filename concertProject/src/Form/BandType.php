<?php

namespace App\Form;

use App\Entity\Band;
use App\Entity\Concert;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class BandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'attr' => array('class' => 'form-control'),
            ])
            ->add('logo', FileType::class,[
                'required' => false,
                'data_class' => null,
                'attr' => array('class' => 'form-control'),
            ])
            ->add('save', SubmitType::class,[
                'attr' => array('class' => 'btn py-2 mt-4 w-100 bg-burple'),
                'label' => 'Create Band'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Band::class,
        ]);
    }
}
