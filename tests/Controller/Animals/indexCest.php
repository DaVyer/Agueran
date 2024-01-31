<?php

namespace App\Tests\Controller\Animals;

use App\Factory\AnimalsFactory;
use App\Tests\Support\ControllerTester;

class indexCest
{
    public function isPageWorkingWithoutAnimal(ControllerTester $I)
    {
        $I->amOnPage('/animaux');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Les animaux du zoo');
        $I->seeCurrentRouteIs('app_animals');
        $I->see('Aucun Animal', 'section.animaux p:last-child');
    }

    public function isPageWorkingWithOneAnimal(ControllerTester $I)
    {
        AnimalsFactory::createOne(
            [
                'nomAnimal' => 'Panda roux',
                'lieuOriginaireAnimal' => 'Asie',
                'descAnimal' => "Le panda roux, appelé aussi petit panda ou panda rouge est un mammifère omnivore natif de l'Himalaya d'Asie du Sud et du Sud-Est. Il est appelé renard de feu en Chine.",
                'image' => 'DataFixtures/data/animals/ID-00077.JPG',
            ]
        );

        $I->amOnPage('/animaux');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Les animaux du zoo');
        $I->seeCurrentRouteIs('app_animals');
        $I->see('1 animal', 'section.animaux p:last-child');
    }

    public function isPageWorkingWithMultipleAnimals(ControllerTester $I)
    {
        AnimalsFactory::createOne(
            [
                'nomAnimal' => 'Loutre cendrée',
                'lieuOriginaireAnimal' => 'Asie',
                'descAnimal' => "Le panda roux, appelé aussi petit panda ou panda rouge est un mammifère omnivore natif de l'Himalaya d'Asie du Sud et du Sud-Est. Il est appelé renard de feu en Chine.",
                'image' => 'DataFixtures/data/animals/ID-00077.JPG',
            ]
        );

        AnimalsFactory::createOne(
            [
                'nomAnimal' => 'Otarie de Californie',
                'lieuOriginaireAnimal' => 'Amérique du Nord',
                'descAnimal' => "L'Otarie de Californie est une grosse otarie, qu'on peut voir notamment dans le port de San Francisco. Elle est en particulier largement utilisée dans les programmes éducatifs, dans les zoos, cirques et parcs d’attractions aquatiques, pour ses capacités de dressage et son agilité.",
                'image' => 'DataFixtures/data/animals/ID-05235.JPG',
            ]
        );

        $I->amOnPage('/animaux');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Les animaux du zoo');
        $I->seeCurrentRouteIs('app_animals');
        $I->see('3 animaux', 'section.animaux p:last-child');
        $I->seeNumberOfElements('div.container', 3);
    }

    public function isButtonLinkWorking(ControllerTester $I)
    {
        $I->amOnPage('/animaux');
        $I->seeResponseCodeIsSuccessful(200);
        $I->click('div.container div.text a');
        $I->amOnPage('/animaux/1');
        $I->seeCurrentRouteIs('app_show_animals');
        $I->see('Le Panda roux', 'div.frame div.home h1');
    }

    public function isSearchButtonRenderingAnimal(ControllerTester $I)
    {
        $I->amOnPage('/animaux');
        $I->seeResponseCodeIsSuccessful(200);
        $I->fillField('search', 'Loutre');
        $I->click('button');
        $I->see('Loutre cendrée', 'div.container div.text div.header p:first-child');
        $I->fillField('search', '');
        $I->click('button');
        $I->see('3 animaux', 'section.animaux p:last-child');
        $I->seeNumberOfElements('div.container', 3);
        $I->fillField('search', 'grhçepgjz');
        $I->click('button');
        $I->see('Aucun animal', 'section.animaux p:last-child');
        $I->see("Aucun animal n'a été trouvé avec votre recherche : grhçepgjz", 'div.container div.information');
        $I->seeNumberOfElements('div.container', 1);
    }
}
