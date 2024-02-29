<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminFromType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('NomAdmin', TextType::class, [
            'attr' => [
                'class' => 'form-control bg-trasparent block border-b-2 border-secondary w-full h-20 text-6xl ouline-none',
            ],
            'label' => 'Nom',
        ])
        ->add('PrenomAdmin', TextType::class, [
            'attr' => [
                'class' => 'form-control bg-trasparent block border-secondary border-b-2 w-full h-20 text-6xl ouline-none',
            ],
            'label' => 'Prenom',
        ])
        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'form-control bg-trasparent block border-secondary border-b-2 w-full h-20 text-6xl ouline-none',
            ],
            'label' => 'Address E-mail',
        ])
      
        ->add('NewPassword', PasswordType::class, [
            'attr' => [
                'class' => 'form-control bg-trasparent block border-secondary border-b-2 w-full h-20 text-6xl ouline-none',
            ],
            'mapped' => false,
            'label' => 'Nouveau mot de passe',
            'required' => false
        ])
        ->add('confirmNewPassword', PasswordType::class, [
            'attr' => [
                'class' => 'form-control bg-trasparent block border-secondary border-b-2 w-full h-20 text-6xl ouline-none',
            ],
            'mapped' => false,
            'label' => 'Confirmer mot de passe',
            'required' => false
        ])
        ->add('checkMeOut', CheckboxType::class, [
            'attr' => [
                'class' => 'ml-2 mt-3'
            ],
            'label' => 'Accepter les modifications:',
            'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
        ])
        ->add('submit', SubmitType::class, [
            
            'label' => 'Modifier',
            'attr' => ['class' => 'btn btn-primary'],
        ]);

          
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
