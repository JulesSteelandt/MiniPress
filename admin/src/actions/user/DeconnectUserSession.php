<?php

namespace minipress\admin\actions\user;

use minipress\admin\actions\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// affiche le form d'une catégorie
class DeconnectUserSession extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        //Supprime l'user dans la session
        $_SESSION['user']=null;

        //Renvoie la page userDeconnected.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, 'user/userDeconnected.twig');
    }
}