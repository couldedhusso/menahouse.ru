<?php

namespace App\Listeners;

use Mail;

use App\Events\RestoreAccountMsgeWasSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RestoreAccountService
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  RestoreAccountMsgeWasSent  $event
     * @return void
     */
    public function handle(RestoreAccountMsgeWasSent $event)
    {
         $user = $event->user;

         Mail::send('mails.restore-account-msg', ['user' => $user, 'msg' => $event->msg], function ($m) use ($user) {
            $m->from('company.menahouse@yandex.ru', 'Support Menahouse');
            $m->to('company.menahouse@yandex.ru', $user->id .' '. $user->email)->subject('Заявка на восстановление');
        });
    }
}
