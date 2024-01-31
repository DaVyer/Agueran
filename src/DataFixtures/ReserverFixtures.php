<?php

namespace App\DataFixtures;

use App\Factory\ReserverFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReserverFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        ReserverFactory::createMany(10);
    }

    public function getDependencies(): array
    {
        return [
            ActiviteFixtures::class,
        ];
    }
}
