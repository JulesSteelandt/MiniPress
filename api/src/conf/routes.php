<?php

return function (Slim\App $app): void {

    $app->get('/api/categorie[/]', \minipress\api\actions\GetCategorie::class);

    $app->get('/api/categorie/{id}/article[/]', \minipress\api\actions\GetArticleByCategorie::class);

};