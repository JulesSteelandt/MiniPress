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

}