<?php

namespace minipress\admin\actions\article;

use minipress\admin\actions\AbstractAction;
use minipress\admin\services\article\ArticleService;
use minipress\admin\services\utilisateur\UserService;
use minipress\admin\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

// affiche le form d'un article
class GetListArticlesByAuteur extends AbstractAction
{

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $csrf = CsrfService::generate();

        if ($csrf['status'] === 500) {
            // lance une erreur
            throw new HttpBadRequestException($request, $csrf['message']);
        }

        $id = $args['id_user'];

        //On recupère l'user
        $user = UserService::getUserById($id);

        //On récupère toute la liste des articles par date de création inverse
        $articles = ArticleService::getArticleByAuteurSortDateCrea($id);

        //Renvoie la page listArticlesByAuteur.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/article/listArticlesByAuteur.twig', ['articles' => $articles,'csrf'=>$csrf['token'],'user'=>$user]);
    }
}