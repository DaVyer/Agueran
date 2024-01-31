<?php

namespace App\Tests\Controller;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class AdminCest
{
    public function _before(ControllerTester $I)
    {
    }

    public function clientsFilter(ControllerTester $I)
    {
        UserFactory::createOne([
            'adresse' => '24 chemin des tests',
            'ville' => 'TestVille',
            'codePostal' => str_replace(' ', '', 511000),
            'pays' => 'FR',
            'email' => 'adminTestou@test.com',
            'nom' => 'Testou',
            'password' => 'test',
            'prenom' => 'TounifLeRoi',
            'roles' => ['ROLE_ADMIN'],
            'telephone' => '0607813011',
        ]);
        $I->amOnPage('/');
        $I->click('div.section3 div.footer-text a:last-child');
        $I->amOnPage('/connexion');
        $I->fillField('email', 'adminTestou@test.com');
        $I->fillField('password', 'test');
        $I->click('button');
        $I->amOnPage('/administration');
        $I->seeInTitle('Administration');
        $I->see("Panel d'administration", 'h1');
        $I->seeCurrentRouteIs('app_admin');
        $I->click('section.admin-menu a:first-child');
        $I->amOnPage('/administration/clients');
        $I->fillField('nom', 'Parker');
        $I->fillField('prenom', 'Peter');
        $I->fillField('email', 'user@example.com');
        $I->click('button');
        $I->seeNumberOfElements('div.admin-item', 1);
        $I->amOnPage('/billetterie/achat');
    }

    public function ticketsFilter(ControllerTester $I)
    {
        $I->amOnPage('/');
        $I->click('div.section3 div.footer-text a:last-child');
        $I->amOnPage('/connexion');
        $I->fillField('email', 'adminTestou@test.com');
        $I->fillField('password', 'test');
        $I->click('button');
        $I->amOnPage('/administration');
        $I->seeInTitle('Administration');
        $I->see("Panel d'administration", 'h1');
        $I->seeCurrentRouteIs('app_admin');
        $I->click('section.admin-menu a:nth-child(2)');
        $I->amOnPage('/administration/billets');
        $I->selectOption('type', 'Tarif réduit');
        $I->click('button');
        $I->see('Aucun billet ne correspond aux critères de recherche.', 'p');
    }

    public function animalsFilter(ControllerTester $I)
    {
        $I->amOnPage('/');
        $I->click('div.section3 div.footer-text a:last-child');
        $I->amOnPage('/connexion');
        $I->fillField('email', 'adminTestou@test.com');
        $I->fillField('password', 'test');
        $I->click('button');
        $I->amOnPage('/administration');
        $I->seeInTitle('Administration');
        $I->see("Panel d'administration", 'h1');
        $I->seeCurrentRouteIs('app_admin');
        $I->click('section.admin-menu a:nth-child(4)');
        $I->amOnPage('/administration/animaux');
        $I->fillField('nomAnimal', 'Loutre');
        $I->click('button');
        $I->seeNumberOfElements('div.admin-item', 1);
    }

    public function eventsFilter(ControllerTester $I)
    {
        $I->amOnPage('/');
        $I->click('div.section3 div.footer-text a:last-child');
        $I->amOnPage('/connexion');
        $I->fillField('email', 'adminTestou@test.com');
        $I->fillField('password', 'test');
        $I->click('button');
        $I->amOnPage('/administration');
        $I->seeInTitle('Administration');
        $I->see("Panel d'administration", 'h1');
        $I->seeCurrentRouteIs('app_admin');
        $I->click('section.admin-menu a:nth-child(3)');
        $I->amOnPage('/administration/evenements');
        $I->fillField('nomActivite', 'Les otaries en action');
        $I->click('button');
        $I->seeNumberOfElements('div.admin-item', 1);
    }

    public function checklist(ControllerTester $I)
    {
        $I->amOnPage('/');
        $I->click('div.section3 div.footer-text a:last-child');
        $I->amOnPage('/connexion');
        $I->fillField('email', 'adminTestou@test.com');
        $I->fillField('password', 'test');
        $I->click('button');
        $I->amOnPage('/administration');
        $I->seeInTitle('Administration');
        $I->see("Panel d'administration", 'h1');
        $I->seeCurrentRouteIs('app_admin');
        $I->click('section.admin-menu a:nth-child(3)');
        $I->amOnPage('/administration/evenements');
        $I->click('a:first-child');
        $I->seeNumberOfElements('div.admin-item', 0);
    }

    public function penFilter(ControllerTester $I)
    {
        $I->amOnPage('/');
        $I->click('div.section3 div.footer-text a:last-child');
        $I->amOnPage('/connexion');
        $I->fillField('email', 'adminTestou@test.com');
        $I->fillField('password', 'test');
        $I->click('button');
        $I->amOnPage('/administration');
        $I->seeInTitle('Administration');
        $I->see("Panel d'administration", 'h1');
        $I->seeCurrentRouteIs('app_admin');
        $I->click('section.admin-menu a:last-child');
        $I->amOnPage('/administration/enclos');
        $I->fillField('nomEnclos', 'Grand bassin');
        $I->click('button');
        $I->seeNumberOfElements('div.admin-item', 1);
    }
}
