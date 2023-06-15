<?php

namespace minipress\admin\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

//Classe Utilisateur correspondant à son équivalent en BD
class Utilisateur extends Model
{
    protected $table = 'utilisateur';
    protected $primaryKey = 'email';
    protected $keyType = 'string';
    public $timestamps = false;

    //Liaison entre utilisateur et article
    public function article() : hasMany
    {
        return $this->hasMany('minipress/api/src/models/Article', 'auteur');
    }

}