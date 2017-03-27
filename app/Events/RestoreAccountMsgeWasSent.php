<?php

namespace App\Events;


use App\User;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RestoreAccountMsgeWasSent extends Event
{
    use SerializesModels;


    public $user;
    public $msg;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, string $msg)
    {
        $this->user =  $user;
        $this->msg =  $msg;

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
