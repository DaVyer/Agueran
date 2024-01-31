<?php

namespace App\Tests\Controller;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class AuthentificationCest
{
    public function _before(ControllerTester $I)
    {
    }

    public function createAccount(ControllerTester $I): void
    {
        $I->amOnPage('/compte/nouveau');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Nouveau compte');
        $I->see('Création de votre Profil', 'h1');
        $I->seeCurrentRouteIs('app_compte_create');
        $I->fillField('user[prenom]', 'Tounif');
        $I->fillField('user[nom]', 'Testou');
        $I->fillField('user[telephone]', '0607813010');
        $I->fillField('user[adresse]', '23 chemin des tests');
        $I->fillField('user[ville]', 'TestVille');
        $I->fillField('user[codePostal]', '511000');
        $I->selectOption('form select', 'Albania');
        $I->fillField('user[email]', 'testou@test.com');
        $I->fillField('user[password]', 'azerty01');
        $I->click('button');
        $I->amOnPage('/connexion');
    }

    public function connectToAccount(ControllerTester $I): void
    {
        UserFactory::createOne([
            'adresse' => '24 chemin des tests',
            'ville' => 'TestVille',
            'codePostal' => str_replace(' ', '', 511000),
            'pays' => 'FR',
            'email' => 'TestouNumeroDeux@test.com',
            'nom' => 'Testou',
            'password' => 'test',
            'prenom' => 'Tounif',
            'roles' => ['ROLE_USER'],
            'telephone' => '0607813011',
        ]);
        $I->amOnPage('/connexion');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Connexion');
        $I->see('Connexion', 'h1');
        $I->seeCurrentRouteIs('app_connexion');
        $I->fillField('email', 'TestouNumeroDeux@test.com');
        $I->fillField('password', 'test');
        $I->click('button');
        $I->amOnPage('/compte');
        $I->see('Votre Profil', 'h1');
    }

    public function modifyAccount(ControllerTester $I): void
    {
        UserFactory::createOne([
            'adresse' => '25 chemin des tests',
            'ville' => 'TestVille',
            'codePostal' => str_replace(' ', '', 511000),
            'pays' => 'FR',
            'email' => 'TestouModification@test.com',
            'nom' => 'Testou',
            'password' => 'test',
            'prenom' => 'Tounif',
            'roles' => ['ROLE_USER'],
            'telephone' => '0607813012',
        ]);
        $I->amOnPage('/connexion');
        $I->fillField('email', 'TestouModification@test.com');
        $I->fillField('password', 'test');
        $I->click('button');
        $I->amOnPage('/compte');
        $I->see('Votre Profil', 'h1');
        $I->click('a:first-child');
        $I->amOnPage('/compte/revision');
        $I->fillField('user[prenom]', 'Xx_Tounif_xX');
        $I->fillField('user[password]', 'test');
        $I->click('button');
        $I->amOnPage('/compte');
    }

    public function deleteAccount(ControllerTester $I): void
    {
        UserFactory::createOne([
            'adresse' => '26 chemin des tests',
            'ville' => 'TestVille',
            'codePostal' => str_replace(' ', '', 511000),
            'pays' => 'FR',
            'email' => 'AdieuTestou@test.com',
            'nom' => 'Testou',
            'password' => 'test',
            'prenom' => 'Tousniff',
            'roles' => ['ROLE_USER'],
            'telephone' => '0607813012',
        ]);
        $I->amOnPage('/connexion');
        $I->fillField('email', 'AdieuTestou@test.com');
        $I->fillField('password', 'test');
        $I->click('button');
        $I->amOnPage('/compte');
        $I->see('Votre Profil', 'h1');
        $I->click('a:last-child');
        $I->amOnPage('/');
    }
}
