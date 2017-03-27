<?php

namespace App ;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receiver extends Eloquent
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'receivers';

  /**
   * The attributes that can be set with Mass Assignment.
   *
   * @var array
   */
  protected $fillable = ['msgid','last_read', 'readed','toid'];


  public function user(){
    return $this->belongsTo('App\User');
  }

  public function notification(){
    return $this->hasMany('App\Notification');
  }

  public function conversation(){
    return $this->belongsTo('App\Conversation');
  }

}
