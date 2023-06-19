<?php

namespace minipress\api\actions;

use minipress\api\services\article\ArticleService;
use minipress\api\services\utilisateur\UtilisateurService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetAuteurAction extends AbstractAction
{

    // méthode invoquée automatiquement à la création de la page
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        //Récupère les articles
        $user = UtilisateurService::getUserById($args['id']);

        //tableau contenant les informations voulues
        $data = [
            'type' => 'collection',
        ];
            $data['user'] = [
                'user' => [
                    'id' => $user['id'],
                    'nom' => $user['nom'],
                    'prenom' => $user['prenom'],
                ],
                'links' => [
                    'self' => [
                        'href' => '/api/auteurs/'.$user['id']."/articles",
                    ],
                ],
            ];


        // les envois sous format json
        $response->getBody()->write(json_encode($data));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

}