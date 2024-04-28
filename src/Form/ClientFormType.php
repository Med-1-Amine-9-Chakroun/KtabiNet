<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ClientFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomClient', TextType::class, [
                'attr' => [
                    'class' => 'form-control bg-trasparent block border-b-2 w-full h-20 text-6xl ouline-none',
                ],
                'label' => 'Nom',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^[A-Za-z]+$/',
                        'message' => 'Le nom doit contenir uniquement des lettres.',
                    ]),
                ],
            ])
            ->add('PrenomClient', TextType::class, [
                'attr' => [
                    'class' => 'form-control bg-trasparent block border-b-2 w-full h-20 text-6xl ouline-none',
                ],
                'label' => 'Prénom',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^[A-Za-z]+$/',
                        'message' => 'Le prénom doit contenir uniquement des lettres.',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control bg-trasparent block border-b-2 w-full h-20 text-6xl ouline-none',
                ],
                'label' => 'Adresse E-mail',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email([
                        'message' => 'Veuillez entrer une adresse email valide.',
                        'mode' => 'strict', // Utiliser le mode strict pour une validation plus stricte
                    ]),
                ],
            ])
            ->add('NumTel', TextType::class, [
                'attr' => [
                    'class' => 'form-control bg-trasparent block border-b-2 w-full h-20 text-6xl ouline-none',
                ],
                'label' => 'Numéro Téléphone',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^(\+)?[0-9]{8,}$/',
                        'message' => 'Veuillez entrer un numéro de téléphone valide.',
                    ]),
                ],
            ])
            ->add('NewPassword', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control bg-trasparent block border-b-2 w-full h-20 text-6xl ouline-none',
                ],
                'mapped' => false,
                'label' => 'Nouveau mot de passe',
                'required' => false
            ])
            ->add('confirmNewPassword', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control bg-trasparent block border-b-2 w-full h-20 text-6xl ouline-none',
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
                    new Assert\IsTrue([
                        'message' => 'Vous devez accepter les modifications.',
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
            'data_class' => Client::class,
        ]);
    }
}
