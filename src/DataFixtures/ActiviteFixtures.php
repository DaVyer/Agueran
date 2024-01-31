<?php

namespace App\DataFixtures;

use App\Factory\ActiviteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class ActiviteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dir = __DIR__;

        ActiviteFactory::createSequence(
            [
                [
                    'libActivite' => 'Le vol des rapaces',
                    'descActivite' => 'Une heure et demie de spectacle non stop avec une cinquantaine de rapaces au dessus de vos têtes !',
                    'image' => $this->getImage("$dir/data/programs/vol-des-rapaces.png"),
                    'dateActivite' => \DateTime::createFromFormat('d-m-Y', '01-12-2023'),
                    'heureDebutActivite' => \DateTime::createFromFormat('H:i', '10:30'),
                    'heureFinActivite' => \DateTime::createFromFormat('H:i', '12:00'),
                    'nbVisiteurMaxActivite' => 30,
                    'estActiviteAnimal' => false,
                ],
                [
                    'libActivite' => 'Nourrissage des lémuriens',
                    'descActivite' => 'Venez nourrir les lémuriens, ces petites créatures qui n’hésiteront pas à vous courrir après pour avoir un bout de pomme...',
                    'image' => $this->getImage("$dir/data/programs/nourrissage-des-lemuriens.png"),
                    'dateActivite' => \DateTime::createFromFormat('d-m-Y', '01-12-2023'),
                    'heureDebutActivite' => \DateTime::createFromFormat('H:i', '12:00'),
                    'heureFinActivite' => \DateTime::createFromFormat('H:i', '12:30'),
                    'nbVisiteurMaxActivite' => 50,
                    'estActiviteAnimal' => true,
                ],
                [
                    'libActivite' => 'Les otaries en action',
                    'descActivite' => 'Vous ne connaissez pas encore les otaries ? Pendant une heure elle vont vous étonner aussi bien dans l’eau que dans les airs !',
                    'image' => $this->getImage("$dir/data/programs/les-otaries-en-action.png"),
                    'dateActivite' => \DateTime::createFromFormat('d-m-Y', '01-12-2023'),
                    'heureDebutActivite' => \DateTime::createFromFormat('H:i', '15:00'),
                    'heureFinActivite' => \DateTime::createFromFormat('H:i', '16:00'),
                    'nbVisiteurMaxActivite' => 200,
                    'estActiviteAnimal' => true,
                ],
            ]
        );
    }

    public function getImage(string $path): string
    {
        $file = new File($path);

        return file_get_contents($file->getPathname());
    }
}
