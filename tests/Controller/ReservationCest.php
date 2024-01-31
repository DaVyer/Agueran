<?php

namespace App\Tests\Controller;

use App\Factory\ActiviteFactory;
use App\Factory\EnclosFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class ReservationCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests
    public function reservationParfaite(ControllerTester $I)
    {
        UserFactory::createOne([
            'adresse' => '24 chemin des tests',
            'ville' => 'TestVille',
            'codePostal' => str_replace(' ', '', 511000),
            'pays' => 'FR',
            'email' => 'envieDeReserver@test.com',
            'nom' => 'Testou',
            'password' => 'test',
            'prenom' => 'Tounif',
            'roles' => ['ROLE_USER'],
            'telephone' => '0607813011',
        ]);
        ActiviteFactory::createOne([
            'libActivite' => 'Test',
            'descActivite' => 'TestReservation',
            'dateActivite' => \DateTime::createFromFormat('d-m-Y', '01-12-2023'),
            'heureDebutActivite' => \DateTime::createFromFormat('H:i', '12:00'),
            'heureFinActivite' => \DateTime::createFromFormat('H:i', '13:00'),
            'nbVisiteurMaxActivite' => 10,
            'estActiviteAnimal' => true,
        ]);
        EnclosFactory::createOne([
            'nomEnclos' => 'Test',
            'descEnclos' => 'Test',
            'activite' => ActiviteFactory::find(['id' => 1]),
        ]);
        $I->amOnPage('/');
        $I->click('div.links a:last-child');
        $I->amOnPage('/programme');
        $I->click('div.container div.text a');
        $I->amOnPage('/programme/1');
        $I->see('Test', 'h1');
        $I->click('a.container');
        $I->fillField('email', 'envieDeReserver@test.com');
        $I->fillField('password', 'test');
        $I->click('button');
        $I->amOnPage('/programme/1/reservation');
        $I->fillField('reserver[nbVisiteurs]', 1);
        $I->click('button');
        $I->amOnPage('/reservations');
        $I->seeNumberOfElements('div.reservations div.reservations-row div.reservations-box:last-child div.reservations-text div.reservations-item:last-child', 1);
    }

    public function echecReservation(ControllerTester $I)
    {
        $I->amOnPage('/');
        $I->click('div.links a:last-child');
        $I->amOnPage('/programme');
        $I->click('div.container div.text a');
        $I->amOnPage('/programme/1');
        $I->see('Test', 'h1');
        $I->click('a.container');
        $I->fillField('email', 'envieDeReserver@test.com');
        $I->fillField('password', 'test');
        $I->click('button');
        $I->amOnPage('/programme/1/reservation');
        $I->fillField('reserver[nbVisiteurs]', 20);
        $I->click('button');
        $I->amOnPage('/programme/1/reservation');
    }
}
