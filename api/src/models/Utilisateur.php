<?php

namespace minipress\api\src\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Utilisateur extends Model
{
    protected $table = 'utilisateur';
    protected $primaryKey = 'email';
    protected $keyType = 'string';
    public $timestamps = true;

    public function article() : hasMany
    {
        return $this->hasMany('minipress/api/src/models/Article', 'auteur');
    }

}