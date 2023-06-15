<?php

use minipress\api\actions\GetArticlesAction;
use minipress\api\actions\GetArticlesByCatAction;

return function (Slim\App $app): void {

    $app->get('/api/articles[/]', GetArticlesAction::class);

    $app->get('/api/categories/{id_cat}/articles[/]', GetArticlesByCatAction::class);

};