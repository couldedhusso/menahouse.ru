<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categorie;

class Nedvizhimosts extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Nedvizhimosts';

    protected $fillable  = ['adressa', 'gorod', 'kolitchestvo_komnat', 'etajnost_doma',
    'zhilaya_ploshad', 'obshaya_ploshad', 'ploshad_kurhnia', 'etazh', 'price',
    'status', 'opicanie', 'user_id','categorie_id' ];

    public function categorie(){
        return $this->belongsTo('App\Categorie');
    }

    public function images()
    {
        return $this->morphMany('App\Images', 'imageable');
    }

}
