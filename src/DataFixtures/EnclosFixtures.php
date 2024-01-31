<?php

namespace App\DataFixtures;

use App\Factory\ActiviteFactory;
use App\Factory\EnclosFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EnclosFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        EnclosFactory::createSequence(
            [
                [
                    'nomEnclos' => 'L’île des lémuriens',
                    'descEnclos' => "Bienvenue sur \"L'île des Lémuriens\" – un coin de paradis insulaire au cœur de notre zoo, où les lémuriens espiègles prospèrent dans un environnement semblable à leur habitat naturel. Cette oasis tropicale a été conçue pour offrir aux visiteurs une immersion totale dans le monde exotique et enjoué de ces primates uniques.",
                    'activite' => ActiviteFactory::find(['id' => 2]),
                ],
                [
                    'nomEnclos' => 'Grand bassin',
                    'descEnclos' => 'Bienvenue au "Grand Bassin" – une oasis aquatique au sein de notre zoo, où la vie aquatique prospère dans un environnement soigneusement créé pour captiver et éduquer les visiteurs sur la diversité fascinante des écosystèmes aquatiques.',
                    'activite' => ActiviteFactory::find(['id' => 3]),
                ],
            ]
        );
    }

    public function getDependencies(): array
    {
        return [ActiviteFixtures::class];
    }
}
