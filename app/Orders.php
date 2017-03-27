<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'profile_id', 'subscription_id' ,'date_payment' ,'payment_reponse',
        'payment_mode',
    ];

    protected $hidden = [
        'payment_date' ,'payment_reponse', 'payment_mode',
    ];

    // public function profile(){
    //     $this->belongsTo('Menahouse\Models\Profile');
    // }

    public function subscription(){
        $this->belongsTo('App\Subscription');
    }
}
