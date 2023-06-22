<?php

namespace minipress\api\services\categorie;

use minipress\api\models\Categorie;


//gère les requetes sql sur Categorie
class CategorieService
{
    //récupère toutes les catégories
    public static function getCategorie(){
        return Categorie::all()->toArray();
    }

    //Recupère la catégorie par son id
    public static function getCategorieById(int $id) : ?array {
        $cat = Categorie::find($id);
        if ($cat!=null) return $cat->toArray();
        return null;
    }

}