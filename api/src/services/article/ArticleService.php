<?php

namespace minipress\api\services\box;

use minipress\api\src\models\Article;

// gère les actions sur les box
class ArticleService {

    public static function getBoxByID(string $id): array {
        $cat = Box::find($id);
        return [$cat];
    }

    // retourne la liste des prestations d'une catégorie
    public static function getPrestationsByBox(string $box_id): array {
        $prestations = Box::find($box_id)->prestation()->get();
        $res = [];
        foreach($prestations as $presta) {
            echo $presta->quantite;
            $res[] = $presta;
        }
        return $res;
    }


}