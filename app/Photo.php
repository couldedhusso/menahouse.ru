<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $table = 'appart_photos';

    protected $fillable = ['path'];
    
    public function obivlenie(){
        return $this->belongsTo('App\Obivlenie');
    }
}
