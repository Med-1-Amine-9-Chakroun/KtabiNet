<?php

use App\Entity\Acces;
use App\Entity\LivrePdf;
use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AccesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Load existing LivrePDF and Client entities
        $livres = $manager->getRepository(LivrePdf::class)->findAll();
        $clients = $manager->getRepository(Client::class)->findAll();

        // Ensure that there are LivrePdf and Client entities available
        if (empty($livres) || empty($clients)) {
            // Load LivrePdf and Client fixtures first or create them programmatically
            // Example: $this->load(LivrePdfFixtures::class); $this->load(ClientFixtures::class);
            // Then retrieve them again
            $livres = $manager->getRepository(LivrePdf::class)->findAll();
            $clients = $manager->getRepository(Client::class)->findAll();
        }

        // Generate sample data for Acces
        foreach ($livres as $livre) {
            foreach ($clients as $client) {
                $acces = new Acces();
                $acces->setDate($faker->dateTimeBetween('-1 year', 'now'));
                $acces->setAcces($faker->boolean);
                $acces->setIdLivrePdf($livre);
                $acces->setIdClient($client);

                $manager->persist($acces);
            }
        }

        $manager->flush();
    }
}
