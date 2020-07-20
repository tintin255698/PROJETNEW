<?php

namespace App\DataFixtures;

use App\Entity\Placement;
use App\Entity\Portefeuille;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker=Factory::create('FR-fr');

        $users =[];
        for($i=1; $i<=5; $i++) {
            $user = new User();

            $user->setPrenom($faker->firstName);
            $user->setNom($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword('password');

            $manager->persist($user);
            $users[] = $user;
        }

        $portefeuilles =[];

        for($i=1; $i<=5; $i++) {

            $user = $users[mt_rand(0,count($users) - 1)];

            $portefeuille = new Portefeuille();

            $portefeuille->setNom('Volatile');
            $portefeuille->setUser($user);

            $manager->persist($portefeuille);
            $portefeuilles[] = $portefeuille;
        }

        for($i=1; $i<=5; $i++) {
            $placement = new Placement();

            $portefeuille = $portefeuilles[mt_rand(0,count($portefeuilles) - 1)];
            $placement->setProduits('Bitcoin');
            $placement->setPrix(10);
            $placement->setQuantite(60);
            $placement->setPortefeuille($portefeuille);

            $manager->persist($placement);
            $placements[] = $placement;
        }


        $manager->flush();
    }
}
