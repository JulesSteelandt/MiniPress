<?php

namespace minipress\api\services\article;

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

    //récupère les articles d'une catégorie
    public static function getArticleByCategorie(int $catId) : array{
        return Article::where("categorie_id", $catId)->get()->toArray();
    }

    // récupère les articles d'un auteur
    public static function getArticlesByAuteur(string $authorId) : array {
        return Article::where('auteur', $authorId)->get()->toArray();
    }
}