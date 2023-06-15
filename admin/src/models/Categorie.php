<?php

namespace minipress\admin\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

//Classe Categorie correspondant à son équivalent en BD
class Categorie extends Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;


    //Liaison entre catégorie et article
    public function article() : hasMany
    {
        return $this->hasMany('minipress/api/src/models/Article', 'categorie_id');
    }

}