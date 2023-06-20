<?php

namespace minipress\api\services\article;

use minipress\api\models\Article;

// gère les requetes sql sur Article
class ArticleService {

    //récupère tous les articles
    public static function getArticle(): array {
        return Article::where('date_publication','!=','null')->get()->toArray();
    }

    //récupère un article avec son id
    public static function getArticleById(int $id): array {
        return Article::where('id',$id)->where('date_publication','!=','null')->get()->toArray();
    }

    //récupère les articles d'une catégorie
    public static function getArticleByCategorie(int $catId) : array{
        return Article::where("categorie_id", $catId)->where('date_publication','!=','null')->get()->toArray();
    }

    // récupère les articles d'un auteur
    public static function getArticlesByAuteur(int $authorId) : array {
        return Article::where('auteur', $authorId)->where('date_publication','!=','null')->get()->toArray();
    }
}