<?php

namespace App\Form;

use App\Entity\Acces;
use App\Entity\LivrePdf;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class AccesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Date')
            ->add('Acces', null, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^[A-Za-z0-9\s\-\'\,\.]+$/',
                        'message' => 'Le champ Acces doit contenir uniquement des lettres, des chiffres, des espaces et des caractères spéciaux (\' \,. -).',
                    ]),
                ],
            ])
            ->add('IdClient', EntityType::class, [
                'class' => Acces::class,
                'choice_label' => 'id', // à adapter en fonction de la propriété à afficher
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Type(['type' => 'integer']),
                ],
                'choice_value' => 'id', // Utilisez l'ID de l'entité comme valeur de choix
            ])
            ->add('IdLivrePdf', EntityType::class, [
                'class' => LivrePdf::class, // replace this line
                'choice_label' => 'id', // à adapter en fonction de la propriété à afficher
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Type(['type' => 'integer']),
                ],
                'choice_value' => 'id', // Utilisez l'ID de l'entité comme valeur de choix
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Acces::class,
        ]);
    }
}
