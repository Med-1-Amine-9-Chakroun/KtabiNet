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
        $client1->setEmail("client1@gmail.com");
        $client1->setNomClient("Azer");
        $client1->setPrenomClient("Romdhani");
        $client1->setNumTel("97643152");
        $client1->setPassword("1234");
        // Enregistrez l'entité dans la base de données            
        $manager->persist($client1);
    
        // Flush pour appliquer les changements
        $manager->flush();



        // Example 2
        $client2 = new Client(); 
        $client2->setEmail("client2@gmail.com");
        $client2->setNomClient("Ahmed");
        $client2->setPrenomClient("Allani");
        $client2->setNumTel("97643152");
        $client2->setPassword("1234");
        // Enregistrez l'entité dans la base de données            
        $manager->persist($client2);
    
        // Flush pour appliquer les changements
        $manager->flush();


        // Example 3
        $client3 = new Client(); 
        $client3->setEmail("client3@gmail.com");
        $client3->setNomClient("Ramzi");
        $client3->setPrenomClient("Aamri");
        $client3->setNumTel("97643152");
        $client3->setPassword("1234");
        // Enregistrez l'entité dans la base de données            
        $manager->persist($client3);
    
        // Flush pour appliquer les changements
        $manager->flush();


        // Example 4
        $client4 = new Client(); 
        $client4->setEmail("client4@gmail.com");
        $client4->setNomClient("Anis");
        $client4->setPrenomClient("Ben Romdhane");
        $client4->setNumTel("97643152");
        $client4->setPassword("1234");
        // Enregistrez l'entité dans la base de données            
        $manager->persist($client4);
    
        // Flush pour appliquer les changements
        $manager->flush();
    
    
            
    }
}
