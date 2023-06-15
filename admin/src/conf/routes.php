<?php

use minipress\admin\actions\GetHomePageAction;

return function (Slim\App $app): void {

    //Page par defaut
    $app->get('[/]', GetHomePageAction::class)->setName('homePage');

};