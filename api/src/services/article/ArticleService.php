<?php

namespace minipress\api\services\article;

use minipress\api\models\Article;

// gère les requetes sql sur Article
class ArticleService {

    //récupère tous les articles
    public static function getArticle(string $sort=null): ?array {
        $art = Article::where('date_publication','!=','null');
        if ($sort!=null){
            switch ($sort){
                case 'date-asc':
                    $art->orderBy('date_publication','asc');
                    break;
                case 'date-desc':
                    $art->orderBy('date_publication','desc');
                    break;
                case 'auteur':
                    $user = $art->utilisateur;
                    var_dump($user);
                    $art = $user->orderBy('nom', 'asc');
                    break;
                default:
                    break;
            }
        }

        if ($art!=null) return $art->get()->toArray();
        return null;
    }

    //récupère un article avec son id
    public static function getArticleById(int $id): ?array {
        $art = Article::where('id',$id)->where('date_publication','!=','null')->first();
        if ($art!=null) return $art->toArray();
        return null;
    }

    //récupère les articles d'une catégorie
    public static function getArticleByCategorie(int $catId) : ?array {
        $art = Article::where("categorie_id", $catId)->where('date_publication','!=','null')->get();
        if ($art!=null) return $art->toArray();
        return null;
    }

    // récupère les articles d'un auteur
    public static function getArticlesByAuteur(int $authorId) : ?array {
        $art =  Article::where('auteur', $authorId)->where('date_publication','!=','null')->get();
        if ($art!=null) return $art->toArray();
        return null;
    }

}