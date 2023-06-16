<?php

namespace minipress\admin\services\article;

use minipress\admin\models\Article;

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
    public static function getArticleByCategorie(int $catId){
        return Article::where("categorie_id", $catId)->get()->toArray();
    }

    //Donne la liste des articles triés par ordre de création, false pour inverser l'ordre
    public static function getArticleSortDateCrea(bool $sort = true){
        $tri = "asc";
        if (!$sort) {
            $tri = "desc";
        }
        return Article::orderBy("date_creation", $tri)->get()->toArray();
    }

    //Créer un article
    public static function createArticle(string $titre, string $resume, string $contenu, int $id_cat){
        $article = new Article();
        $article->titre = $titre;
        $article->resume = $resume;
        $article->contenu = $contenu;
        $article->categorie_id = $id_cat;
        $article->date_creation = date("Y-m-d H:i:s");
        $article->save();
    }


}