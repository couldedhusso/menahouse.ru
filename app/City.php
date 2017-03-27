<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "cities";

    protected $fillable  = ['name'];

    protected $guarded = array('id');


    public function district(){
        return $this->hasMany('App\District');
    }

    public function obivlenie(){
        return $this->hasMany('App\Obivlenie');
    }

}
