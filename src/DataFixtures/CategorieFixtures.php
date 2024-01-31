<?php

namespace App\DataFixtures;

use App\Factory\CategorieFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $str = file_get_contents(__DIR__.'/data/Categorie.json');
        $array_Enclos = json_decode($str, true);
        CategorieFactory::createSequence($array_Enclos);
    }
}
