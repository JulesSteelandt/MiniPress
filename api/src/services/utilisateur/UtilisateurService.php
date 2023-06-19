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
     * @return Utilisateur l'objet représentant l'utilisateur
     */
    public static function getUtilisateurById(int $utilisateurId) : Utilisateur {
        return Utilisateur::find($utilisateurId);
    }
}