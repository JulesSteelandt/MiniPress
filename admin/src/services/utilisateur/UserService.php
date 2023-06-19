<?php

namespace minipress\admin\services\utilisateur;

use Faker\Calculator\Iban;
use minipress\admin\models\Utilisateur;


//gère les requetes sql sur Utilisateur
class UserService
{

    //Verifie que l'email de l'user n'est pas déjà enregistré
    static function emailUserVerif(string $email):bool{
        return Utilisateur::find($email) == null;
    }

    //Créer un utilisateur
    static function createUser(string $email, string $mdp){
        $user = new Utilisateur();
        $user->email = $email;
        $user->mot_de_passe= password_hash($mdp,PASSWORD_DEFAULT);
        $user->save();
    }

    static function connexionUser(string $email, string $mdp){
        $user = Utilisateur::where("email",$email)->first();
        if (password_verify($mdp,$user->mot_de_passe)){
            return $user;
        }
        return null;
    }

    static function checkPassword($password) : bool
    {
        $filterPassword = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($password != $filterPassword) return false;
        if (strlen($password) < 5) return false;
        if (!preg_match('/[A-Z]/', $password)) return false;
        if (!preg_match('~[0-9]+~', $password)) return false;

        return true;
    }

    static function checkString($str) :bool
    {
        $filterStr = filter_var($str, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($filterStr == $str){
            return true;
        } else {
            return false;
        }
    }




}