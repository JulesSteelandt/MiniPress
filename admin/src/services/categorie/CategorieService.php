<?php

namespace minipress\admin\services\categorie;

use minipress\admin\models\Categorie;


//gère les requetes sql sur Categorie
class CategorieService
{
    //récupère toutes les catégories
    public static function getCategorie(){
        return Categorie::all()->toArray();
    }

    //récupère une catégorie avec son id
    public static function getCategorieById(int $id){
        return Categorie::find($id)->first()->toArray();
    }




    //Créer une catégorie
    public static function createCategorie(string $nom){
        $cat = new Categorie();
        $cat->nom = $nom;
        $cat->save();
    }

}