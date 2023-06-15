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

}