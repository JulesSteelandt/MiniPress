<?php

namespace minipress\admin\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $table = 'article';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function categorie() : BelongsTo
    {
        return $this->belongsTo('minipress/api/src/models/Categorie', 'categorie_id');
    }

    public function utilisateur() : BelongsTo
    {
        return $this->belongsTo('minipress/api/src/models/Utilisateur', 'auteur');
    }

}