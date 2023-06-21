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

        $email = $params['email'];
        $mdp = $params['mdp'];
        $nom = $params['nom'];
        $prenom = $params['prenom'];
        $mdpVerif = $params['mdpVerif'];
        $csrf = $params['csrf'];

        //Verifie le token
        CsrfService::check($csrf);

        if (!UserService::emailUserVerif($email)){
            $view = Twig::fromRequest($request);
            return $view->render($response, '/user/formSignUpUser.twig',['email'=>true, 'csrf'=>$csrf]);
        }

        if ($mdp!=$mdpVerif){
            $view = Twig::fromRequest($request);
            return $view->render($response, '/user/formSignUpUser.twig',['mdpIdentique'=>true, 'csrf'=>$csrf]);
        }

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