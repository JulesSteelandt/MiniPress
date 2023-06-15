<?php

namespace minipress\admin\actions\article;

use minipress\admin\actions\AbstractAction;
use minipress\admin\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;
use minipress\admin\services\categorie\CategorieService;

// affiche le form d'un article
class GetFormCreateArticle extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        //Génère un token csrf
        $csrf = CsrfService::generate();

        if ($csrf['status'] === 500) {
            // lance une erreur
            throw new HttpBadRequestException($request, $csrf['message']);
        }

        //récupère les catégories
        $categs = CategorieService::getCategorie();


        //Renvoie la page formCreateCategorie.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/article/formCreateArticle.twig',['csrf' => $csrf['token'], 'categs'=>$categs]);
    }
}