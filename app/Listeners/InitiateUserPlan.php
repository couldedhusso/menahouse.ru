<?php

namespace App\Listeners;

use App\Events\ObivlyavleniyeWasStored;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Carbon\Carbon;

use App\Subscription;
use App\User;

use Menahouse\CustomHelper;

class InitiateUserPlan
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $set_license ;
    public function __construct()
    {
        // $this->set_license = new CustomHelper();
    }

    /**
     * Handle the event.
     *
     * @param  ObivlyavleniyeWasStored  $event
     * @return void
     */
    public function handle(ObivlyavleniyeWasStored $event)
    {
          //dd($event->user_license);

          $subscr = Subscription::where('user', $event->user->id)->first();

          // si ns avons pas encore atteint le quota requis ns attribuons 
          // un periode d essai

          $user = User::latest()->first();

          if (null === $subscr &&  $user->id < 2000 ){

                Subscription::create([
                     'user' => $event->user->id,
                     'plan' => 'trial', // silver
                     'ends_at' => null,
                     'trial_ends_at' => Carbon::now('UTC')->addMonth() 
                ]);
          }
         //
         //  $this->set_license->setUserPlanToken($event->user_license);
    }
}
