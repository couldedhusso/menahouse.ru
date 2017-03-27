<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    protected $table = 'blocks';
    protected $fillable = ['user_id', 'user_block_id', 'unlock_user'];

    public function is_blockedBy($user_id, $user_lock_id){
           return DB::table('blocks')->where(['user_id' => $user_id,
                                        'user_block_id' => $user_lock_id])
                                ->select('unlock_user')
                                ->first();
    }

}

