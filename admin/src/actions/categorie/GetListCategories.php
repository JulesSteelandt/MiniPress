<?php

namespace minipress\admin\actions\categorie;

use minipress\admin\actions\AbstractAction;
use minipress\admin\services\categorie\CategorieService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// affiche le form d'un article
class GetListCategories extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        //On récupère toute la liste des catégories
        $categories = CategorieService::getCategorie();

        //Renvoie la page formCreateCategorie.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/categorie/listCategories.twig',['categories'=>$categories]);
    }
}