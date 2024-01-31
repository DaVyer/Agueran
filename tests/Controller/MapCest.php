<?php

namespace App\Tests\Controller;

use App\Tests\Support\ControllerTester;

class MapCest
{
    public function _before(ControllerTester $I)
    {
    }

    public function isOkMap(ControllerTester $I): void
    {
        $I->amOnPage('/carte');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Plan du Zoo');
        $I->see('Plan du Zoo', 'h1');
        $I->seeCurrentRouteIs('app_map');
    }
}
