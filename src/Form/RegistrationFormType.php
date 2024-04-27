<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'form-control bg-transparent border-secondary border-b-2 text-6xl outline-none',
                'placeholder' => 'Adresse E-mail',
            ],
            'constraints' => [
                new Assert\Email([
                    'message' => 'Veuillez entrer une adresse email valide.',
                    'mode' => 'strict', // Utiliser le mode strict pour une validation plus stricte
                ]),
            ],
        ])
        // ->add('agreeTerms', CheckboxType::class, [
        //     'mapped' => false,
        //     'constraints' => [
        //         new Assert\IsTrue([
        //             'message' => 'Vous devez accepter nos conditions.',
        //         ]),
        //     ],
        //     'label' => 'Accepter les conditions',
        //     'attr' => [
        //         'class' => 'form-check-input',
        //     ],
        // ])
        ->add('password', PasswordType::class, [
            
            'attr' => [
                'class' => 'form-control',
                'autocomplete' => 'new-password',
                'placeholder' => 'Mot de passe',
            ],
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Veuillez entrer un mot de passe.',
                ]),
                new Assert\Length([
                    'min' => 6,
                    'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères.',
                    'max' => 4096,
                ]),
            ],
        ])
        ->add('NomClient', TextType::class, [
            'attr' => [
                'class' => 'form-control bg-transparent border-secondary border-b-2 text-6xl outline-none',
                'placeholder' => 'Nom',
            ],
            'label' => 'Nom',
            'constraints' => [
                new Assert\Regex([
                    'pattern' => '/^[A-Za-z]+$/',
                    'message' => 'Le nom doit contenir uniquement des lettres.',
                ]),
            ],
        ])
        ->add('PrenomClient', TextType::class, [
            'attr' => [
                'class' => 'form-control bg-transparent border-secondary border-b-2 text-6xl outline-none',
                'placeholder' => 'Prénom',
            ],
            'label' => 'Prénom',
            'constraints' => [
                new Assert\Regex([
                    'pattern' => '/^[A-Za-z]+$/',
                    'message' => 'Le prénom doit contenir uniquement des lettres.',
                ]),
            ],
        ])
        ->add('NumTel', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Numéro de téléphone',
            ],
            'label' => 'Numéro de téléphone',
            'constraints' => [
                new Assert\Regex([
                    'pattern' => '/^(\+)?[0-9]{8,}$/',
                    'message' => 'Veuillez entrer un numéro de téléphone valide.',
                ]),
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
