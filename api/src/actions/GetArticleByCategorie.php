<?php

namespace minipress\api\actions;

use minipress\api\services\article\ArticleService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetArticleByCategorie extends AbstractAction
{

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        //Retourne les articles d'une catégorie
        $articles = ArticleService::getArticleByCategorie($args['id']);

        //tableau contenant les informations voulues
        $data = [
            'type' => 'collection',
            'count' => count($articles),
        ];
        foreach ($articles as $art) {
            $data['articles'][] = [
                'article' => [
                    'titre' => $art['titre'],
                    'date_creation' => $art['date_creation'],
                    'auteur' => $art['auteur'],
                ],
                'links' => [
                    'self' => [
                        'href' => '/api/articles/'.$art['id'],
                    ],
                ],
            ];
        }

        // les envois sous format json
        $response->getBody()->write(json_encode($data));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}