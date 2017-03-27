<?php

namespace App\Events;

use Carbon\Carbon;

abstract class Event
{
    public $created_at;
    public function __construct(){
       $this->created_at = Carbon::now();
    }
}
