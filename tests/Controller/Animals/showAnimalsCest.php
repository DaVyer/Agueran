<?php

namespace App\Tests\Controller\Animals;

use App\Factory\ActiviteFactory;
use App\Factory\AnimalsFactory;
use App\Factory\UtiliserFactory;
use App\Tests\Support\ControllerTester;

class showAnimalsCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests
    public function isPageWorking(ControllerTester $I)
    {
        $I->amOnPage('/animaux/1');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Animal');
        $I->seeCurrentRouteIs('app_show_animals');
        $I->see('Le Panda roux', 'div.frame div.home h1');
    }

    public function isProgramShowingWhenExisting(ControllerTester $I)
    {
        AnimalsFactory::createOne(
            [
                'nomAnimal' => 'Pygargue à tête blanche',
                'lieuOriginaireAnimal' => 'Amérique du Nord',
                'descAnimal' => 'Le Pygargue à tête blanche est un très gros oiseau. Ses ailes, bien adaptées au vol plané, sont larges et longues, leur envergure atteignant plus de 2 m.',
                'image' => 'DataFixtures/data/animals/ID-00440.JPG',
            ]
        );

        ActiviteFactory::createOne(
            [
                'libActivite' => 'Le vol des rapaces',
                'descActivite' => 'Une heure et demie de spectacle non stop avec une cinquantaine de rapaces au dessus de vos têtes !',
                'image' => 'DataFixtures/data/programs/vol-des-rapaces.png',
                'nbVisiteurMaxActivite' => 30,
            ]
        );

        UtiliserFactory::createOne(
            [
                'lieu' => 'Rocher des rapaces',
                'activiter' => ActiviteFactory::find(['id' => 1]),
                'animal' => AnimalsFactory::find(['id' => 4]),
            ]
        );

        $I->amOnPage('/animaux/4');
        $I->see('Le vol des rapaces', 'div.container div.text div.header p');
    }

    public function isProgramNotShowingWhenNotExisting(ControllerTester $I)
    {
        $I->amOnPage('/animaux/1');
        $I->see("Aucune activité n'est prévue pour cet animal !", 'p:last-child');
    }

    public function isRedirectionWorking(ControllerTester $I)
    {
        $I->amOnPage('/animaux/4');
        $I->click('a.button');
        $I->see('Le vol des rapaces', 'div.frame div.home h1');
    }
}
