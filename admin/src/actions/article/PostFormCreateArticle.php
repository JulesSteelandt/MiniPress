<?php

namespace minipress\admin\actions\article;

use minipress\admin\actions\AbstractAction;
use minipress\admin\services\article\ArticleService;
use minipress\admin\services\utils\CsrfService;
use Parsedown;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

// creer un article
class PostFormCreateArticle extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        //Recupère les valeurs du form
        $params = $request->getParsedBody();

        $titre = $params['titre'];
        $resume = $params['resume'];
        $contenu = $params['contenu'];
        $cat = $params['categorie'];
        $csrf = $params['csrf'];

        //Verifie le token
        CsrfService::check($csrf);

        //Insertion en base de donnée
        ArticleService::createArticle($titre,$resume,$contenu,$cat);

        //Renvoie la page formCreateCategorie.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/article/articleCreated.twig');
    }
}