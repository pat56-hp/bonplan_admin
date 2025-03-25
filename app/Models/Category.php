<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['libelle', 'icon', 'status', 'created_by'];

    public function etablissements(){
        return $this->hasMany(Etablissement::class, 'category_id');
    }
}
