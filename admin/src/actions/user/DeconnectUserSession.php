<?php

namespace minipress\admin\actions\user;

use minipress\admin\actions\AbstractAction;
use minipress\admin\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;
use minipress\admin\services\categorie\CategorieService;

// affiche le form d'une catégorie
class DeconnectUserSession extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $_SESSION['user']=null;

        //Renvoie la page homePage.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, 'homePage.twig');
    }
}