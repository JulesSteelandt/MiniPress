<?php

use minipress\api\actions\GetArticlesByIdAction;
use minipress\api\actions\GetArticlesAction;
use minipress\api\actions\GetCategorie;
use minipress\api\actions\GetArticleByCategorie;

return function (Slim\App $app): void {


    //Accéder aux catégories
    $app->get('/api/categories[/]', GetCategorie::class);

    //Accéder aux articles d'une catégorie avec l'id de la catégorie
    $app->get('/api/categories/{id}/articles[/]', GetArticleByCategorie::class);

    //accéder aux articles
    $app->get('/api/articles[/]', GetArticlesAction::class);

    //accéder à un article avec son id
    $app->get('/api/articles/{id_a}', GetArticlesByIdAction::class);

};