<?php

use minipress\admin\actions\article\GetFormCreateArticle;
use minipress\admin\actions\categorie\GetFormCreateCategorie;
use minipress\admin\actions\categorie\PostFormCreateCategorie;
use minipress\admin\actions\GetHomePageAction;
use minipress\admin\actions\article\PostFormCreateArticle;
use minipress\admin\actions\article\GetListArticles;
return function (Slim\App $app): void {

    //Page par defaut
    $app->get('[/]', GetHomePageAction::class)->setName('homePage');

    //Formulaire de création d'un article
    $app->get('/articles/new[/]', GetFormCreateArticle::class)->setName('formArticle');

    //Creation d'un article
    $app->post('/articles/new[/]', PostFormCreateArticle::class)->setName('CreateArticle');

    //Formulaire de création d'une catégorie
    $app->get('/categories/new[/]', GetFormCreateCategorie::class)->setName('formCat');

    //Creation d'une catégorie
    $app->post('/categories/new[/]', PostFormCreateCategorie::class)->setName('CreateCat');

    //Liste des articles
    $app->get('/articles[/]', GetListArticles::class)->setName('listArticle');

    //Liste des catégories
    $app->get('/categories[/]', GetListArticles::class)->setName('listCat');

    //Liste des articles par catégorie
    $app->get('/categories/{id_cat}/articles[/]', GetListArticles::class)->setName('listArticleByCat');

};