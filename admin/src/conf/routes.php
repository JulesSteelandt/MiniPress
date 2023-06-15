<?php

use minipress\admin\actions\article\GetFormCreateCategorie;
use minipress\admin\actions\GetHomePageAction;
use minipress\admin\actions\article\PostFormCreateArticle;

return function (Slim\App $app): void {

    //Page par defaut
    $app->get('[/]', GetHomePageAction::class)->setName('homePage');

    //Formulaire de création d'un article
    $app->get('/article/new[/]', GetFormCreateCategorie::class)->setName('formArticle');

    //Creation d'un article
    $app->post('/article/new[/]', PostFormCreateArticle::class)->setName('CreateArticle');

    //Formulaire de création d'une catégorie
    $app->get('/article/new[/]', GetFormCreateCategorie::class)->setName('formArticle');

    $app->post('/article/new[/]', PostFormCreateArticle::class)->setName('CreateArticle');

};