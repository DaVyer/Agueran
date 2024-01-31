<?php

namespace App\Tests\Controller;

use App\Tests\Support\ControllerTester;

class MiscellaneousCest
{
    public function _before(ControllerTester $I)
    {
    }

    public function isOkFAQ(ControllerTester $I): void
    {
        $I->amOnPage('/faq');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('FAQ');
        $I->see('FAQ', 'h1');
        $I->seeCurrentRouteIs('app_faq');
    }

    public function isOkConfidentialite(ControllerTester $I): void
    {
        $I->amOnPage('/confidentialite');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Confidentialité');
        $I->see('Confidentialité', 'h1');
        $I->seeCurrentRouteIs('app_confidentialite');
    }

    public function isOkReglement(ControllerTester $I): void
    {
        $I->amOnPage('/reglement');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Règlement');
        $I->see('Règlement', 'h1');
        $I->seeCurrentRouteIs('app_reglement');
    }

    public function isOkCGV(ControllerTester $I): void
    {
        $I->amOnPage('/cgv');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('CGV Billeterie');
        $I->see('Conditions Générales de Vente', 'h1');
        $I->seeCurrentRouteIs('app_cgv');
    }

    public function isOkMentionsLégales(ControllerTester $I): void
    {
        $I->amOnPage('/mentions');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Mentions légales');
        $I->see('Mentions légales', 'h1');
        $I->seeCurrentRouteIs('app_mentions');
    }

    public function isOkNousContacter(ControllerTester $I): void
    {
        $I->amOnPage('/contacter');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Nous contacter');
        $I->see('Nous contacter', 'h1');
        $I->seeCurrentRouteIs('app_contacter');
    }

    public function isOkActualites(ControllerTester $I): void
    {
        $I->amOnPage('/actualites');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Actualités');
        $I->see('Actualités', 'h1');
        $I->seeCurrentRouteIs('app_actualites');
    }

    public function isOkEmplois(ControllerTester $I): void
    {
        $I->amOnPage('/emplois');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Emplois');
        $I->see('Emplois', 'h1');
        $I->seeCurrentRouteIs('app_emplois');
    }

    public function isOkAPropos(ControllerTester $I): void
    {
        $I->amOnPage('/propos');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('A propos');
        $I->see('A propos', 'h1');
        $I->seeCurrentRouteIs('app_propos');
    }
}
