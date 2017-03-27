<?php

namespace App ;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;


class Conversation extends Eloquent
{

  use SoftDeletes ;


  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'conversations';

  /**
   * The attributes that can be set with Mass Assignment.
   *
   * @var array
   */
  protected $fillable = ['id', 'subject'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  public function messages()
  {
      return $this->hasMany('App\UserMessage');
  }

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  public function user()
  {
      return $this->hasMany('App\User');
  }




}
