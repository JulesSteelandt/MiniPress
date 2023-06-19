<?php

namespace minipress\api\services\utilisateur;

use minipress\api\models\Utilisateur;

/**
 * Service pour les opérations sur les utilisateurs
 */
class UtilisateurService {
    /**
     * Retrouve un utilisateur avec son id
     *
     * @param int $utilisateurId id de l'utilisateur
     * @return Utilisateur | null l'objet représentant l'utilisateur
     */
    public static function getUtilisateurById(int $utilisateurId) : Utilisateur | null {
        return Utilisateur::where('id', $utilisateurId)->first();
    }


    //récupère tous les articles
    public static function getUserById($id): array {
        return Utilisateur::where("id", $id)->first()->toArray();
    }
}