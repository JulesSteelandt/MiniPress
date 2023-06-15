<?php

namespace minipress\admin\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function article() : hasMany
    {
        return $this->hasMany('minipress/api/src/models/Article', 'categorie_id');
    }

}