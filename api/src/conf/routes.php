<?php

use minipress\api\actions\GetArticles;
use minipress\api\actions\GetArticlesByCat;

return function (Slim\App $app): void {

    $app->get('/api/articles[/]', GetArticles::class);

    $app->get('/api/categories/{id_cat}/articles[/]', GetArticlesByCat::class);

};