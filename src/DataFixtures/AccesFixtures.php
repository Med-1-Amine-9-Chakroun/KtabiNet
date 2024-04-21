<?php

namespace App\DataFixtures;

use App\Entity\Acces;
use App\Entity\LivrePdf;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AccesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Load existing LivrePDF entities
        $livres = $manager->getRepository(LivrePdf::class)->findAll();

        // Ensure that there are LivrePdf entities available
        if (empty($livres)) {
            // If there are no LivrePdf entities, load LivrePdf fixtures first or create them programmatically
            // Example: $this->load(LivrePdfFixtures::class);
            // Then retrieve them again
            $livres = $manager->getRepository(LivrePdf::class)->findAll();
        }

        // Generate sample data for Acces
        foreach ($livres as $livre) {
            $acces = new Acces();
            $acces->setDate($faker->dateTimeBetween('-1 year', 'now'));
            $acces->setAcces($faker->boolean);
            $acces->setIdLivrePdf($livre);

            $manager->persist($acces);
        }

        $manager->flush();
    }
}
