<?php

namespace minipress\admin\actions\article;

use minipress\admin\actions\AbstractAction;
use minipress\admin\services\article\ArticleService;
use minipress\admin\services\categorie\CategorieService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// affiche le form d'un article
class GetListArticlesByCat extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        //On récupère l'id de la catégorie
        $id_cat = $args['id_cat'];

        //On récupère toute la liste des articles d'une catégorie
        $categorie = CategorieService::getCategorieById($id_cat);
        $articles = ArticleService::getArticleByCategorieSort($id_cat);

        //Renvoie la page formCreateCategorie.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/article/listArticlesByCat.twig',['categorie'=>$categorie, 'articles'=>$articles]);
    }
}