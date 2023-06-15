<?php

namespace minipress\admin\actions\article;

use minipress\admin\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// affiche une catégorie
class PostFormCreateArticle extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        //Renvoie la page homePage.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, 'formCreateArticle.twig');
    }
}