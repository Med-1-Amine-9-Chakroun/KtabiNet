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

        // Generate sample data for Acces
        for ($i = 0; $i < 100; $i++) {
            $acces = new Acces();
            $acces->setDate($faker->dateTimeBetween('-1 year', 'now'));
            $acces->setAcces($faker->boolean);

            // Fetch a random LivrePDF entity only if $livres array is not empty
            if (!empty($livres)) {
                $livre = $livres[array_rand($livres)];
                $acces->setIdLivrePdf($livre->getIdLivrePdf());
                $manager->persist($acces);
            }
        }

        $manager->flush();
    }
}
