<?php

namespace minipress\admin\actions\user;

use minipress\admin\actions\AbstractAction;
use minipress\admin\services\utilisateur\UserService;
use minipress\admin\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// affiche le form d'une catégorie
class PostFormConnexionUser extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        //Génère un token csrf
        $params = $request->getParsedBody();

        //Récupère les données du formulaire
        $email = filter_var($params['email'], FILTER_SANITIZE_EMAIL);
        $mdp = $params['mdp'];
        $csrf = $params['csrf'];

        //Verifie le token
        CsrfService::check($csrf);

        //Connecte l'utilisateur
        $user = UserService::connexionUser($email,$mdp);

        //Si l'user n'dxiste pas, l'email ou le mot de passe est incorrect
        if ($user == null){
            //Renvoie la page formSignInUser.twig
            $view = Twig::fromRequest($request);
            return $view->render($response, '/user/formSignInUser.twig',['fail'=>true, 'csrf'=>$csrf]);

        }else{
            $_SESSION['user'] = $user;
        }

        //Renvoie la page userConnected.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/user/userConnected.twig',['nom'=>$user->nom,'prenom'=>$user->prenom]);
    }
}