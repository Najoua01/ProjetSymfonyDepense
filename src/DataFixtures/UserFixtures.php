<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR'); 
        
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setLogin($faker->email)
                ->setPassword($faker->password); // Attention: stocker les mots de passe en texte brut n'est pas recommandé en production

            $manager->persist($user);
        }

        $manager->flush();
    }
}
