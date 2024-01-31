<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne(
            [
                'nom' => 'Stark',
                'prenom' => 'Tony',
                'email' => 'root@example.com',
                'roles' => ['ROLE_ADMIN'],
            ]
        );

        UserFactory::createOne(
            [
                'nom' => 'Lemaire',
                'prenom' => 'Yoan',
                'email' => 'yoan.lemaire@agueran.com',
                'roles' => ['ROLE_SOIGNEUR'],
            ]
        );

        UserFactory::createOne(
            [
                'nom' => 'Parker',
                'prenom' => 'Peter',
                'email' => 'user@example.com',
                'roles' => ['ROLE_USER'],
            ]
        );

        UserFactory::createMany(10);
    }
}
