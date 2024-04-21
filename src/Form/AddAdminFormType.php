<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddAdminFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('NomAdmin', TextType::class, [
            'attr' => [
                'class' => 'form-control bg-trasparent block border-b-2 border-secondary w-full h-20 text-6xl ouline-none',
            ],
            'label' => 'Nom',
            'constraints' => [
                new Assert\Regex([
                    'pattern' => '/^[A-Za-z]+$/',
                    'message' => 'Le nom doit contenir uniquement des lettres.',
                ]),
            ],
        ])
        ->add('PrenomAdmin', TextType::class, [
            'attr' => [
                'class' => 'form-control bg-trasparent block border-secondary border-b-2 w-full h-20 text-6xl ouline-none',
            ],
            'label' => 'Prenom',
            'constraints' => [
                new Assert\Regex([
                    'pattern' => '/^[A-Za-z]+$/',
                    'message' => 'Le prénom doit contenir uniquement des lettres.',
                ]),
            ],
        ])
        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'form-control bg-trasparent block border-secondary border-b-2 w-full h-20 text-6xl ouline-none',
            ],
            'label' => 'Address E-mail',
        ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control bg-trasparent block border-secondary border-b-2 w-full h-20 text-6xl ouline-none',
                ],
                
                'label' => 'Mot de passe',
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
            
                'label' => 'Ajouter',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
