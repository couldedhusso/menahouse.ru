<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    /// protected $timestamps = false ;
    protected $fillable = ['id', 'name'];

    public function nedvizhimosts(){
      return $this->hasMany('App\Nedvizhimosts');
    }

    public function obivlenie(){
      return $this->hasMany('App\Obivlenie');
    }
}
