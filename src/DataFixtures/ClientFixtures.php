<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Example 1
        $client1 = new Client();
        $client1->setEmail("client1@gmail.com")
            ->setNomClient("Azer")
            ->setPrenomClient("Romdhani")
            ->setNumTel("97643152")
            ->setPassword("1234");

        // Persist and flush
        $manager->persist($client1);
        $manager->flush();

        // Assigning reference to client_1
        $this->addReference('client_1', $client1);

        // Example 2
        $client2 = new Client();
        $client2->setEmail("client2@gmail.com")
            ->setNomClient("Ahmed")
            ->setPrenomClient("Allani")
            ->setNumTel("97643152")
            ->setPassword("1234");

        // Persist and flush
        $manager->persist($client2);
        $manager->flush();

        // Assigning reference to client_2
        $this->addReference('client_2', $client2);

        // Example 3
        $client3 = new Client();
        $client3->setEmail("client3@gmail.com")
            ->setNomClient("Ramzi")
            ->setPrenomClient("Aamri")
            ->setNumTel("97643152")
            ->setPassword("1234");

        // Persist and flush
        $manager->persist($client3);
        $manager->flush();

        // Assigning reference to client_3
        $this->addReference('client_3', $client3);

        // Example 4
        $client4 = new Client();
        $client4->setEmail("client4@gmail.com")
            ->setNomClient("Anis")
            ->setPrenomClient("Ben Romdhane")
            ->setNumTel("97643152")
            ->setPassword("1234");

        // Persist and flush
        $manager->persist($client4);
        $manager->flush();

        // Assigning reference to client_4
        $this->addReference('client_4', $client4);
    }
}
