<?php

namespace minipress\api\actions;

use minipress\api\services\article\ArticleService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetArticlesAction extends AbstractAction
{

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {


        $params = $request->getQueryParams();
        $sort = null;
        if (isset($params['sort'])){
            $sort = $params['sort'];
        }
        //Récupère les articles
        $articles = ArticleService::getArticle($sort);

        //tableau contenant les informations voulues
        $data = [
            'type' => 'collection',
            'count' => count($articles),
        ];
        foreach ($articles as $article) {
            $data['articles'][] = [
                'article' => [
                    'titre' => $article['titre'],
                    'date_creation' => $article['date_creation'],
                    'auteur' => $article['auteur'],
                ],
                'links' => [
                    'self' => [
                        'href' => '/api/articles/'.$article['id'],
                    ],
                ],
            ];
        }


        // les envois sous format json
        $response->getBody()->write(json_encode($data));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

}