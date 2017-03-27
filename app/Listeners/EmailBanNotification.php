<?php

namespace App\Listeners;

use Mail;

use App\Events\UserWasBanned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailBanNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserWasBanned  $event
     * @return void
     */
    public function handle(UserWasBanned $event)
    {

         $user = $event->user;

         Mail::send('mails.ban-notification', ['user' => $user], function ($m) use ($user) {
            $m->from('company.menahouse@yandex.ru', 'Support Menahouse');
            $m->to('company.menahouse@yandex.ru', $user->name)->subject('Уведомление о блокировке');
        });
    }
}
