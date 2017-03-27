<?php

namespace App\Listeners;

use App\Events\MessageWasPosting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageSender
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
     * @param  MessageWasPosting  $event
     * @return void
     */
    public function handle(MessageWasPosting $event)
    {
        //
    }
}
