<?php

namespace minipress\admin\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

//Classe Article correspondant à son équivalent en BD
class Article extends Model
{
    protected $table = 'article';
    protected $primaryKey = 'id';
    public $timestamps = true;

    //Liaison entre article et catégorie
    public function categorie() : BelongsTo
    {
        return $this->belongsTo('minipress/api/src/models/Categorie', 'categorie_id');
    }


    //Liaison entre article et utilisateur
    public function utilisateur() : BelongsTo
    {
        return $this->belongsTo('minipress/api/src/models/Utilisateur', 'auteur');
    }

}