<?php

namespace minipress\api\actions;

use minipress\api\services\article\ArticleService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetArticlesByIdAction extends AbstractAction
{

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        //Récupère un article selon son id donné dans l'URL
        $article = ArticleService::getArticleById($args['id_a']);
        //tableau contenant les informations voulues
        if ($article!=null) {
            $data = [
                'type' => 'collection',
                'article' => [
                    'id' => $article['id'],
                    'titre' => $article['titre'],
                    'resume' => $article['resume'],
                    'contenu' => $article['contenu'],
                    'categorie_id' => $article['categorie_id'],
                    'date_creation' => $article['date_creation'],
                    'date_publication' => $article['date_publication'],
                    'auteur' => $article['auteur'],
                    'image' => $article['image'],
                ],
            ];
        }else{
            $data = [
                'type' => 'collection',
                'article' => 'null'
                ];
        }

        // les envois sous format json
        $response->getBody()->write(json_encode($data));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

}