<?php

namespace minipress\admin\services\article;

use minipress\api\models\Article;

// gère les requetes sql sur Article
class ArticleService {

    //récupère tous les articles
    public static function getArticle(): array {
        return Article::all()->toArray();
    }

    //récupère un article avec son id
    public static function getArticleById(int $id): array {
        return Article::find($id)->toArray();
    }


}