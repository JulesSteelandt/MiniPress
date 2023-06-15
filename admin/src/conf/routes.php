<?php

use minipress\admin\actions\article\GetFormCreateArticle;
use minipress\admin\actions\GetHomePageAction;
use minipress\admin\actions\article\PostFormCreateArticle;

return function (Slim\App $app): void {

    //Page par defaut
    $app->get('[/]', GetHomePageAction::class)->setName('homePage');

    //Formulaire de création d'un article
    $app->get('/article/new[/]', GetFormCreateArticle::class)->setName('formArticle');

    $app->post('/article/new[/]', PostFormCreateArticle::class)->setName('CreateArticle');

};