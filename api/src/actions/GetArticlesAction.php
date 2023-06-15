<?php

namespace minipress\api\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use minipress\api\services\article\ArticleService;

class GetArticlesAction extends AbstractAction
{

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $articles = ArticleService::getArticle();

        $data = [
            'type' => 'collection',
            'count' => count($articles),
            ['links' => [
                'all' => [
                    'href' => '/articles/'
                ],
              ],
            ]
        ];
        foreach ($articles as $article) {
            $data['articles'][] = [
                'categorie' => [
                    'titre' => $article['titre'],
                    'date_creation' => $article['date_creation'],
                    'auteur' => $article['auteur'],
                ],
            ];
        }

        $response->getBody()->write(json_encode($data));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

}