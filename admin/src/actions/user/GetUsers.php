<?php

namespace minipress\admin\actions\user;

use minipress\admin\actions\AbstractAction;
use minipress\admin\services\utilisateur\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// affiche le form d'un article
class GetUsers extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {


        $users = UserService::getUser();

        //Renvoie la page listUser.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/user/listUser.twig',['users'=>$users]);
    }
}