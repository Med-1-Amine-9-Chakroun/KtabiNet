<?php

namespace App\DataFixtures;

use App\Entity\Commande;
use App\Entity\Client; // Import Client entity
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory; // Import Factory class from Faker

class CommandeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create(); // Use Factory to create Faker instance

        // Generate sample data for Commande
        for ($i = 0; $i < 10; $i++) {
            $commande = new Commande();
            $commande->setDateCommande(
                $faker->dateTimeBetween('-1 year', 'now')
            );

            // Set a random price total
            $commande->setPrixTotal($faker->randomNumber(4));

            // Set a random number of books
            $commande->setNbreLivres($faker->numberBetween(1, 10));

            // Fetch or generate sample Client entity
            $clientReference = 'client_' . rand(1, 4);
            /** @var Client $client */
            $client = $this->getReference($clientReference);
            $commande->setIdClient((int)$client); // Set the ID of the Client entity

            $manager->persist($commande);
        }

        $manager->flush();
    }
}
