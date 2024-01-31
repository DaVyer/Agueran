<?php

namespace App\DataFixtures;

use App\Factory\ActiviteFactory;
use App\Factory\AnimalsFactory;
use App\Factory\UtiliserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UtiliserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        UtiliserFactory::createSequence(
            [
                [
                    'lieu' => 'Rocher des rapaces',
                    'activiter' => ActiviteFactory::find(['id' => 1]),
                    'animal' => AnimalsFactory::find(['id' => 5]),
                ],
            ]
        );
    }

    public function getDependencies(): array
    {
        return [ActiviteFixtures::class];
    }
}
