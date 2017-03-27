<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plainte extends Model
{
    protected $table = 'plaintes';
    protected $fillable = ['plaignant', 'auteur_faits', 'faits_reproches'];
}