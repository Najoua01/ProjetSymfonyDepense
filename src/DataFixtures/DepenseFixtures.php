<?php

namespace App\DataFixtures;

use App\Entity\Depense;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class DepenseFixtures extends Fixture
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Obtenez tous les utilisateurs
        $users = $this->userRepository->findAll();

        // Créez 10 dépenses avec Faker
        for ($i = 0; $i < 10; $i++) {
            $depense = new Depense();
            $depense->setDate($faker->dateTimeBetween('-1 year', 'now'));
            $depense->setSomme($faker->randomFloat(2, 10, 1000));
            $depense->setAchat($faker->word);
            $depense->setRemarque($faker->sentence(10,true));  // 10 mots en français
            
            // Sélectionnez un utilisateur au hasard et associez-le à la dépense
            $randomUser = $faker->randomElement($users);
            $depense->setUser($randomUser);

            // Vérifiez si l'utilisateur n'est pas nul avant d'appeler addDepense()
            if ($randomUser !== null) {
                $randomUser->addDepense($depense); // mettre à jour la relation dans l'entité User
                $manager->persist($randomUser); // persistez l'utilisateur pour mettre à jour la relation
            }
            
            $manager->persist($depense);
        }

        $manager->flush();
    }
}
