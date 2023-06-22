<?php

namespace minipress\admin\actions\categorie;

use minipress\admin\actions\AbstractAction;
use minipress\admin\services\categorie\CategorieService;
use minipress\admin\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;


// creer une catégorie
class PostFormCreateCategorie extends AbstractAction {

    // méthode magique invoquée pour gérer l'action
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        //Recupère les valeurs du form
        $params = $request->getParsedBody();

        $nom = filter_var($params['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
        $csrf = $params['csrf'];

        //Verifie le token
        CsrfService::check($csrf);

        if (CategorieService::getCategorieByName($nom)!=null){
            $view = Twig::fromRequest($request);
            return $view->render($response, '/categorie/formCreateCategorie.twig',['csrf' => $csrf,'exist'=>true]);
        }

        //Insertion en base de donnée
        CategorieService::createCategorie($nom);

        //Renvoie la page formCreateCategorie.twig
        $view = Twig::fromRequest($request);
        return $view->render($response, '/categorie/categorieCreated.twig');
    }
}