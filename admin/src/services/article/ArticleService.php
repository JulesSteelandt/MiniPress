<?php

namespace minipress\admin\services\article;

use minipress\admin\models\Article;

// gère les requetes sql sur Article
class ArticleService
{

    //récupère tous les articles
    public static function getArticle(): ?array
    {
        $art = Article::all();
        if ($art!=null) return $art->toArray();
        return null;
    }

    //récupère un article avec son id
    public static function getArticleById(int $id): ?array
    {
        $art = Article::find($id);
        if ($art!=null) return $art->toArray();
        return null;
    }

    //récupère les articles d'une catégorie
    public static function getArticleByCategorieSort(int $catId, bool $sort = false)
    {
        $tri = "asc";
        if (!$sort) {
            $tri = "desc";
        }
        return Article::where("categorie_id", $catId)->orderBy("date_creation", $tri)->get()->toArray();
    }

    //Donne la liste des articles triés par ordre de création, false pour inverser l'ordre
    public static function getArticleSortDateCrea(bool $sort = false)
    {
        $tri = "asc";
        if (!$sort) {
            $tri = "desc";
        }
        return Article::orderBy("date_creation", $tri)->get()->toArray();
    }

    public static function getArticleByAuteurSortDateCrea(int $id, bool $sort = false)
    {
        $tri = "asc";
        if (!$sort) {
            $tri = "desc";
        }
        return Article::where('auteur', $id)->orderBy("date_creation", $tri)->get()->toArray();
    }

    public static function publicationService(int $id)
    {
        $art = Article::find($id);
        if ($art->date_publication == null){
            self::publierUnArticle($id);
        }else{
            self::depublierUnArticle($id);
        }
    }

    private static function publierUnArticle(int $id)
    {
        $art = Article::find($id);
        $art->date_publication = date("Y-m-d H:i:s");
        $art->save();
    }

    private static function depublierUnArticle(int $id)
    {
        $art = Article::find($id);
        $art->date_publication = null;
        $art->save();
    }

    //Créer un article
    public static function createArticle(string $titre, string $resume, string $contenu, int $id_cat,string $url)
    {
        $article = new Article();
        $article->titre = $titre;
        $article->resume = $resume;
        $article->contenu = $contenu;
        $article->categorie_id = $id_cat;
        $article->date_creation = date("Y-m-d H:i:s");
        $article->auteur = $_SESSION['user']->id;
        $article->image = $url;
        $article->save();
    }


}