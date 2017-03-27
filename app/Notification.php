<?php

namespace App ;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Eloquent
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'notifications';

  /**
   * The attributes that can be set with Mass Assignment.
   *
   * @var array
   */
  protected $fillable = ['userid', 'msgid' ,'notify'];



  public function user(){
    return $this->belongsTo('App\User');
  }

  public function usermessages(){
    return $this->belongsTo('App\UserMessages');
  }


}
