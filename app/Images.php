<?php

 namespace App ;

 use Illuminate\Database\Eloquent\Model;

 class Images extends Model
 {

   // protected $timestamps = true ;
   protected $fillable  = ['path'];

   protected $guarded = array('id');

   public function imageable()
   {
     return $this->morphTo();
   }
   
   /*public function nedvizhimosts(){
     return $this->morphToMany('App\Nedvizhimosts', 'imageable')
   }

   public function profile(){
     return $this->morphToMany('App\User', 'imageable')
   }*/

 }
