<?php

namespace minipress\api\actions;

use minipress\api\services\categorie\CategorieService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCategorie extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $categories = CategorieService::getCategorie();

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
                        'href' => '/api/categorie/' . $categorie['id'] . '/article',
                    ]
                ]
            ];
        }

        $response->getBody()->write(json_encode($data));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}