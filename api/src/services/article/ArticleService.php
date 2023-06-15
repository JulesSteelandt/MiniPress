<?php

namespace minipress\api\services\article;

use minipress\api\models\Article;

// gère les actions sur les box
class ArticleService {

    public static function getArticle(): array {
        return Article::all()->toArray();
    }

    public static function getArticleById(int $id): array {
        return Article::find($id)->toArray();
    }


}