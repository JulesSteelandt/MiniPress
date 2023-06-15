<?php

use minipress\api\actions\GetArticlesAction;
use minipress\api\actions\GetArticlesByIdAction;

return function (Slim\App $app): void {

    $app->get('/api/articles[/]', GetArticlesAction::class);

    $app->get('/api/articles/{id_a}', GetArticlesByIdAction::class);

};