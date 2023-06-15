<?php

namespace minipress\api\actions;

use minipress\api\services\categorie\ArticleService;
use minipress\api\services\categorie\CategorieService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetArticleByCategorie extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $articles = ArticleService::getArticleByCategorie($args['id']);

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
            ];
        }

        $response->getBody()->write(json_encode($data));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}