<?php

namespace minipress\admin\actions\article;

use minipress\admin\actions\AbstractAction;
use minipress\admin\services\article\ArticleService;
use minipress\admin\services\utilisateur\UserService;
use minipress\admin\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// creer un article
class PostPublication extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        //Recupère les valeurs du form
        $params = $request->getParsedBody();

        $idArt = $params['publication'];
        $csrf = $params['csrf'];

        //Verifie le token
        CsrfService::check($csrf);


        ArticleService::publicationService($idArt);


        $id = $args['id_user'];

        $user = UserService::getUserById($id);

        $articles = ArticleService::getArticleByAuteurSortDateCrea($id);


        //Renvoie la page formCreateCategorie.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/article/listArticlesByAuteur.twig',['articles'=>$articles, 'csrf'=>$csrf, 'user'=>$user]);
    }
}