<?php

return function (Slim\App $app): void {

    $app->get('/api/categorie[/]', \minipress\api\actions\GetCategorie::class);

    $app->get('/api/categorie/{id}/article[/]', \minipress\api\actions\GetArticleByCategorie::class);

    //accéder aux articles
    $app->get('/api/articles[/]', GetArticlesAction::class);

    //accéder à un article avec son id
    $app->get('/api/articles/{id_a}', GetArticlesByIdAction::class);

};