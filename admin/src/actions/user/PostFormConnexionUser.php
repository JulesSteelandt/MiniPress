<?php

namespace minipress\admin\actions\user;

use minipress\admin\actions\AbstractAction;
use minipress\admin\services\utilisateur\UserService;
use minipress\admin\services\utils\CsrfService;
use PhpParser\Error;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// affiche le form d'une catégorie
class PostFormConnexionUser extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        //Génère un token csrf
        $params = $request->getParsedBody();

        $email = $params['email'];
        $mdp = $params['mdp'];
        $csrf = $params['csrf'];

        //Verifie le token
        CsrfService::check($csrf);

        $user = UserService::connexionUser($email,$mdp);

        if ($user == null){
            throw new Error("util marche pas");
        }else{
            $_SESSION['user'] = $user;
        }

        //Renvoie la page formCreateCategorie.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/user/userConnected.twig',['nom'=>$user->nom,'prenom'=>$user->prenom]);
    }
}