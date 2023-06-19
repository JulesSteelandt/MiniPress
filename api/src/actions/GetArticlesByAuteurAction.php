<?php

namespace minipress\api\actions;

use minipress\api\services\article\ArticleService;
use minipress\api\services\auteur\AuteurService;
use minipress\api\services\utilisateur\UtilisateurService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Affiche les articles d'un auteur
 */
class GetArticlesByAuteurAction extends AbstractAction {

    // méthode magique invoquée quand l'action est demandée
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        // récupère l'auteur et ses articles
        $auteur = UtilisateurService::getUtilisateurById($args['id']);
        $articles = ArticleService::getArticlesByAuteur($args['id']);

        //tableau contenant les informations voulues
        $data = [
            'user' => [
                'id' => $auteur->id,
                'email' => $auteur->email,
                'lastname' => $auteur->nom,
                'firstname' => $auteur->prenom
            ],
            'articles' => [
                'type' => 'collection',
                'count' => count($articles),
            ]
        ];

        // parcours les articles et inscrit le lien
        foreach ($articles as $article){
            $data['articles'][] = [
                'link' => [
                    'self' => [
                        'href' => '/api/articles/' . $article['id'] . '/',
                    ],
                ],
            ];
        }

        // écrit les données dans la réponse
        $response->getBody()->write(json_encode($data));

        // envoie la réponse en format json
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}