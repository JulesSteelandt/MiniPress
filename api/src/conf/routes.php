<?php

use minipress\api\actions\GetArticlesAction;
use minipress\api\actions\GetArticlesByIdAction;

return function (Slim\App $app): void {


    //accéder aux articles
    $app->get('/api/articles[/]', GetArticlesAction::class);

    //accéder à un article avec son id
    $app->get('/api/articles/{id_a}', GetArticlesByIdAction::class);

};