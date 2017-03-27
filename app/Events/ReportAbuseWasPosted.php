<?php

namespace App\Events;

use App\Events\Event;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReportAbuseWasPosted extends Event
{
    use SerializesModels;

    public $user;
    public $reports;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct(User $auteur_user, array $reports)
    {
        $this->user = $auteur_user;
        $this->reports = $reports;
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
