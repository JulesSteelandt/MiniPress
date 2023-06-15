<?php

namespace minipress\admin\actions\article;

use minipress\admin\actions\AbstractAction;
use minipress\admin\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;
use minipress\admin\services\categorie\CategorieService;

// affiche une catégorie
class GetFormCreateArticle extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $csrf = CsrfService::generate();

        $categs = CategorieService::getCategorie();

        if ($csrf['status'] === 500) {
            // lance une erreur
            throw new HttpBadRequestException($request, $csrf['message']);
        }

        //Renvoie la page homePage.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/article/formCreateArticle.twig',['csrf' => $csrf['token'], 'categs'=>$categs]);
    }
}