<?php

namespace App;
//use Menahouse\Laravel\Cashier;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subscription extends Model
{
    protected $table = "subscriptions";

    /// , 'expire', 'paiemant_confirmation', 'date_paiement'


  protected $dates = [
        'trial_ends_at', 'ends_at',
        'created_at', 'updated_at',
    ];


    protected $fillable = [
        'user' ,'plan', 'price', 'quantity', 'ends_at', 'trial_ends_at'
    ];


     /**
     * Get the user that owns the subscription.
     */
    public function user()
    {
        return $this->owner();
    }
    /**
     * Get the model related to the subscription.
     */
    public function owner()
    {
        // $model = getenv('STRIPE_MODEL') ?: config('services.stripe.model', 'App\\User');
        //  $model = new $model;
        return $this->belongsTo('App\User');
    }


    /**
     * Determine if the subscription is active, on trial, or within its grace period.
     *
     * @return bool
     */
    public function valid()
    {
        // return $this->active() || $this->onTrial() || $this->onGracePeriod();
        return $this->active() || $this->onTrial();
    }

    /**
     * Determine if the subscription is active.
     *
     * @return bool
     */

    public function active()
    {
        // return is_null($this->ends_at) || $this->onGracePeriod();
        return is_null($this->ends_at);
    }

    /**
     * Begin creating a new subscription.
     *
     * @param  string  $subscription
     * @param  string  $plan
     * @return \Laravel\Cashier\SubscriptionBuilder
     */
    // public function newSubscription($subscription, $plan)
    // {
    //     return new SubscriptionBuilder($this, $subscription, $plan);
    // }


        /**
     * Determine if the Stripe model is on trial.
     *
     * @param  string  $subscription
     * @param  string|null  $plan
     * @return bool
     */
    public function onTrial($subscription = 'free', $plan = null)
    {
        if (func_num_args() === 0 && $this->onGenericTrial()) {
            return true;
        }
        $subscription = $this->subscription($subscription);
        if (is_null($plan)) {
            return $subscription && $subscription->onTrial();
        }
        return $subscription && $subscription->onTrial() &&
               $subscription->plan === $plan;
    }
    /**
     * Determine if the Stripe model is on a "generic" trial at the model level.
     *
     * @return bool
     */
    public function onGenericTrial()
    {
        return $this->trial_ends_at && Carbon::now()->lt($this->trial_ends_at);
    }
    
    public function onValidPeriod()
    {
        // $subscription = $this->subscription();
        // if (is_null($subscription)) {
        //     return false;
        // }
        $today = Carbon::now('UTC');

        if ($this->plan == 'trial'){

            if ($today->lt($this->trial_ends_at)) {
                return true;
            }
            
            return false;
        }

        if ($today->lt($this->ends_at)) {

            return true;
        }

        return false;
        /// return $this->trial_ends_at && Carbon::now()->lt($this->trial_ends_at);
    }

    /**
     * Determine if the Stripe model has a given subscription.
     *
     * @param  string  $subscription
     * @param  string|null  $plan
     * @return bool
     */

    // public function subscribed($subscription = 'free', $plan = null)
    // {
    //     $subscription = $this->subscription($subscription);
    //     if (is_null($subscription)) {
    //         return false;
    //     }
    //     if (is_null($plan)) {
    //         return $subscription->valid();
    //     }
    //     return $subscription->valid() &&
    //            $subscription->plan === $plan;
    // }


    /**
     * Get a subscription instance by name.
     *
     * @param  string  $subscription
     * @return \Laravel\Cashier\Subscription|null
     */
    public function subscription($subscription = 'free')
    {
        return $this->subscriptions->sortByDesc(function ($value) {
            return $value->created_at->getTimestamp();
        })
        ->first(function ($value) use ($subscription) {
            return $value->name === $subscription;
        });
    }

    
   //  $table->timestamp('ends_at')->nullable();

    // public function promocode(){
    //     $this->hasMany('Menahouse\Models\Promocode');
    // }

    // public function profile(){
        
    //     $this->belongsTo("Menahouse\Model\Profile");
    // }
}
