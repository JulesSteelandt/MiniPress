<?php

namespace minipress\api\services\categorie;


use minipress\api\models\Article;

class ArticleService
{
    public static function getArticleByCategorie(int $catId){
        return Article::where("categorie_id", $catId)->get()->toArray();
    }

}