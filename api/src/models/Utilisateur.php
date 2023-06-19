<?php

namespace minipress\api\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

//Classe Utilisateur correspondant à son équivalent en BD
class Utilisateur extends Model
{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'id';
    public $timestamps = true;

    //Liaison entre utilisateur et article
    public function article() : hasMany
    {
        return $this->hasMany('minipress/api/src/models/Article', 'auteur');
    }

}