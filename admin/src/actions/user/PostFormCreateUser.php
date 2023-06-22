<?php

namespace minipress\admin\actions\user;

use minipress\admin\actions\AbstractAction;
use minipress\admin\services\utilisateur\UserService;
use minipress\admin\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;


// creer une catégorie
class PostFormCreateUser extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        //Recupère les valeurs du form
        $params = $request->getParsedBody();

        $email = filter_var($params['email'], FILTER_VALIDATE_EMAIL);
        $mdp = $params['mdp'];
        $nom = filter_var($params['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_var($params['prenom'], FILTER_SANITIZE_SPECIAL_CHARS);
        $mdpVerif = $params['mdpVerif'];
        $csrf = $params['csrf'];

        //Verifie le token
        CsrfService::check($csrf);

        //On vérifie que l'email existe pas déjà
        if (!UserService::emailUserVerif($email)){
            $view = Twig::fromRequest($request);
            return $view->render($response, '/user/formSignUpUser.twig',['email'=>true, 'csrf'=>$csrf]);
        }

        //On vérifie que les mots de passes sont idéntiques
        if ($mdp!=$mdpVerif){
            $view = Twig::fromRequest($request);
            return $view->render($response, '/user/formSignUpUser.twig',['mdpIdentique'=>true, 'csrf'=>$csrf]);
        }

        //On vérifie que le mot de passe est assez sécurisé
        if (!UserService::checkPassword($mdp)){
            $view = Twig::fromRequest($request);
            return $view->render($response, '/user/formSignUpUser.twig',['mdpCheck'=>true, 'csrf'=>$csrf]);
        }

        //Insertion en base de donnée
        UserService::createUser($email,$mdp,$nom,$prenom);

        //Renvoie la page formCreateCategorie.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/user/userCreated.twig');
    }
}