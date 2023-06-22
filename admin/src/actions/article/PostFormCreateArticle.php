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

        $titre = filter_var($params['titre'], FILTER_SANITIZE_SPECIAL_CHARS);
        $resume = $params['resume'];
        $contenu = $params['contenu'];
        $cat = filter_var($params['categorie'], FILTER_VALIDATE_INT);
        $image = filter_var($params['image'], FILTER_VALIDATE_URL,FILTER_SANITIZE_URL);
        $csrf = $params['csrf'];

        //Verifie le token
        CsrfService::check($csrf);

        //Insertion en base de donnée
        ArticleService::createArticle($titre,$resume,$contenu,$cat,$image);

        //Renvoie la page formCreateCategorie.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/article/articleCreated.twig');
    }
}