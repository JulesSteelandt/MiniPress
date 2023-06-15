<?php

namespace minipress\api\services\categorie;

use minipress\api\models\Categorie;

class CategorieService
{
    public static function getCategorie(){
        return Categorie::all()->toArray();
    }

}