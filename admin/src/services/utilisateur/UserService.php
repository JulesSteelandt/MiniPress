<?php

namespace minipress\admin\services\utilisateur;

use minipress\admin\models\Utilisateur;


//gère les requetes sql sur Utilisateur
class UserService
{

    //Verifie que l'email de l'user n'est pas déjà enregistré
    static function emailUserVerif(string $email):bool{
        return Utilisateur::where('email',$email)->first() == null;
    }

    //Créer un utilisateur
    static function createUser(string $email, string $mdp, string $nom, string $prenom){
        $user = new Utilisateur();
        $user->email = $email;
        $user->mot_de_passe = password_hash($mdp,PASSWORD_DEFAULT);
        $user->nom = $nom;
        $user->prenom = $prenom;
        $user->statut = 1;
        $user->save();
    }

    //Retourne l'user si l'email et le mot de passe corresponde
    static function connexionUser(string $email, string $mdp){
        $user = Utilisateur::where("email",$email)->first();
        if ($user!=null) {
            if (password_verify($mdp, $user->mot_de_passe)) {
                return $user;
            }
        }
        return null;
    }

    //Retourne la liste des users
    static function getUser(): ?array{
        $user = Utilisateur::all();
        if ($user!=null) return $user->toArray();
        return null;
    }

    //Retourne l'user avec son id
    static function getUserById(int $id) : ?array{
        $user = Utilisateur::find($id);
        if ($user!=null) return $user->toArray();
        return null;
    }

    //Verifie la sécurité du mot de passe
    static function checkPassword($password) : bool
    {
        $filterPassword = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($password != $filterPassword) return false;
        if (strlen($password) < 5) return false;
        if (!preg_match('/[A-Z]/', $password)) return false;
        if (!preg_match('~[0-9]+~', $password)) return false;

        return true;
    }

}