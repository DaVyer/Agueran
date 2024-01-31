<?php

namespace App\DataFixtures;

use App\Factory\BilletFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BilletFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        BilletFactory::createOne(
            [
                'visiteur' => UserFactory::find(['id' => 1]),
                'dateAchat' => new \DateTime(),
                'dateReservation' => \DateTime::createFromFormat('d-m-Y', '01-12-2024'),
            ]
        );

        BilletFactory::createMany(10);
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
