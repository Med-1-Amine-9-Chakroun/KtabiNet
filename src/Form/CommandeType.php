<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints as Assert;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DateCommande', DateTimeType::class)
            ->add('idClient')
            ->add('prixTotal', TextType::class, [
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^\d+(\.\d{1,2})?$/',
                        'message' => 'Le prix total doit être un nombre décimal positif avec au plus deux décimales.'
                    ]),
                ],
            ]) // Champ pour le prix
            ->add('NbreLivres', NumberType::class) // Champ pour le nombre de livres
            ->add('etat', TextType::class, [
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^[A-Za-z\s\-\'\,\.]+$/',
                        'message' => 'L\'état de la commande doit contenir uniquement des lettres, des espaces et des caractères spéciaux (\' \ , . -).',
                    ]),
                ],
            ]); // Champ pour l'état de la commande
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
