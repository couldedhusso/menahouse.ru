<?php

namespace App;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Message extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';


    /**
     * The attributes that can be set with Mass Assignment.
     *
     * @var array
     */
    protected $fillable = ['thread_id', 'user_id', 'body'];

    /**
     * Validation rules.
     *
     * @var array
     */
    protected $rules = [
        'body' => 'required',
    ];

    /**
     * Convertion relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function convertion()
    {
        return $this->belongsTo('App\Convertion');
    }

    /**
     *  Notification of message
     *
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function  notification(){
        return $this->hasMany('App\Notification');
     }

    /**
     * User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Config::get('messenger.user_model'));
    }


}
