<?php

namespace App ;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sender extends Eloquent
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'senders';

  /**
   * The attributes that can be set with Mass Assignment.
   *
   * @var array
   */
  protected $fillable = ['msgid', 'userid'];


  public function user(){
    return $this->belongsTo('App\User');
  }

  public function conversation(){
    return $this->belongsTo('App\Conversation');
  }

}
