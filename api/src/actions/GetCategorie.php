<?php

namespace minipress\api\actions;

use minipress\api\services\categorie\CategorieService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCategorie extends AbstractAction
{

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        //Retourne toutes les catégories
        $categories = CategorieService::getCategorie();

        //tableau contenant les informations voulues
        $data = [
            'type' => 'collection',
            'count' => count($categories),
        ];
        foreach ($categories as $categorie) {
            $data['categories'][] = [
                'categorie' => [
                    'id' => $categorie['id'],
                    'nom' => $categorie['nom'],
                ],
                'links' => [
                    'self' => [
                        'href' => '/api/categories/' . $categorie['id'] . '/articles',
                    ]
                ]
            ];
        }

        // les envois sous format json
        $response->getBody()->write(json_encode($data));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}