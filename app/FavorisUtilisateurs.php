<?php namespace App ;

use Illuminate\Eloquent\Model;

/**
 * gestion des favoris(messages, publications ) utilisateur
 */
class FavorisUtilisateurs extends Model
{
    protected $fillable = ['user_id', 'deleted', 'bkm_date'];
    protected $guarded =  array('id');

    // public function favorisutilisateurable(){
    //   return this->morphTo();
    // }

    public function bookmarkable(){
      return $this->morphTo();
    }
}
