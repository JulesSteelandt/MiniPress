<?php

use minipress\admin\actions\article\GetFormCreateArticle;
use minipress\admin\actions\categorie\GetFormCreateCategorie;
use minipress\admin\actions\categorie\PostFormCreateCategorie;
use minipress\admin\actions\GetHomePageAction;
use minipress\admin\actions\article\PostFormCreateArticle;

return function (Slim\App $app): void {

    //Page par defaut
    $app->get('[/]', GetHomePageAction::class)->setName('homePage');

    //Formulaire de création d'un article
    $app->get('/articles/new[/]', GetFormCreateArticle::class)->setName('formArticle');

    //Creation d'un article
    $app->post('/articles/new[/]', PostFormCreateArticle::class)->setName('CreateArticle');

    //Formulaire de création d'une catégorie
    $app->get('/categories/new[/]', GetFormCreateCategorie::class)->setName('formCat');

    $app->post('/categories/new[/]', PostFormCreateCategorie::class)->setName('CreateCat');

};