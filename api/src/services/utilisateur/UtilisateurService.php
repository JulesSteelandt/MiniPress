<?php

namespace minipress\api\services\utilisateur;

use minipress\api\models\Article;
use minipress\api\models\Utilisateur;

// gère les requetes sql sur Article
class UtilisateurService {

    //récupère tous les articles
    public static function getUserById($id): array {
        return Utilisateur::where("id", $id)->first()->toArray();
    }
}