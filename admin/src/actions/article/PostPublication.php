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

        $idArt = filter_var($params['publication'], FILTER_VALIDATE_INT);
        $csrf = $params['csrf'];

        //Verifie le token
        CsrfService::check($csrf);


        //Publie ou dépublie l'article
        ArticleService::publicationService($idArt);


        //Recupère les données pour mettre à jour la page
        $id = $args['id_user'];

        $user = UserService::getUserById($id);

        $articles = ArticleService::getArticleByAuteurSortDateCrea($id);


        //Renvoie la page listArticlesByAuteur.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/article/listArticlesByAuteur.twig',['articles'=>$articles, 'csrf'=>$csrf, 'user'=>$user]);
    }
}