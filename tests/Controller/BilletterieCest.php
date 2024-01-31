<?php

namespace App\Tests\Controller;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class BilletterieCest
{
    public function _before(ControllerTester $I)
    {
    }

    public function booking(ControllerTester $I)
    {
        UserFactory::createOne([
            'adresse' => '24 chemin des tests',
            'ville' => 'TestVille',
            'codePostal' => str_replace(' ', '', 511000),
            'pays' => 'FR',
            'email' => 'Testou@test.com',
            'nom' => 'Testou',
            'password' => 'test',
            'prenom' => 'Tounif',
            'roles' => ['ROLE_USER'],
            'telephone' => '0607813011',
        ]);
        $I->amOnPage('/');
        $I->click('div.footer-text a:first-child');
        $I->amOnPage('/connexion');
        $I->fillField('email', 'Testou@test.com');
        $I->fillField('password', 'test');
        $I->click('button');
        $I->amOnPage('/billetterie');
        $I->seeInTitle('Billetterie');
        $I->see('Billetterie', 'h1');
        $I->seeCurrentRouteIs('app_billetterie');
        $I->see('0€', 'p.total');
        $I->fillField('billet[quantity20]', 5);
        $I->fillField('billet[quantity15]', 5);
        $I->fillField('billet[quantity5]', 5);
        $I->fillField('billet[dateReservation]', '2024-03-09');
        $I->click('button');
        $I->amOnPage('/billetterie/achat');
    }
}
