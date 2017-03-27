<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmarked extends Model
{
  protected $table = 'bookmarked';

  ///  obivlenie_id == item_id
  protected $fillable = ['id', 'obivlenie_id', 'deleted', 'user_id'];
}
