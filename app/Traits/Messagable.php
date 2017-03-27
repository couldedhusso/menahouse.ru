<?php

namespace App\Traits;

use  App\Thread;
use  App\Participant;
use App\Receiver;
use DB;
use Auth;

trait Messagable
{
    /**
     * Message relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('App\UserMessage');
    }

    /**
     * Thread relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function threads()
    {
        return $this->belongsToMany('App\UserMessage', 'receiver');
    }

    /**
     * Returns the new messages count for user
     *
     * @return int
     */
    public function newMessagesCount()
    {

        return $this->getCountNewMessages();
        // return count($this->threadsWithNewMessages());
    }

    /**
     * Returns all threads with new messages
     *
     * @return array
     */
    public function threadsWithNewMessages()
    {
        $threadsWithNewMessages = [];

        $newMessageCount = [] ;
        $receiver = Receiver::where('toid', $this->id)->lists('last_read', 'msgid');

        $participants = Participant::where('user_id', $this->id)->lists('last_read', 'thread_id');

        /**
         * @todo: see if we can fix this more in the future.
         * Illuminate\Foundation is not available through composer, only in laravel/framework which
         * I don't want to include as a dependency for this package...it's overkill. So let's
         * exclude this check in the testing environment.
         */
        if (getenv('APP_ENV') == 'testing' || !str_contains(\Illuminate\Foundation\Application::VERSION, '5.0')) {
            $participants = $participants->all();
        }

        if ($participants) {
            $threads = Thread::whereIn('id', array_keys($participants))->get();

            foreach ($threads as $thread) {
                if ($thread->updated_at > $participants[$thread->id]) {
                    $threadsWithNewMessages[] = $thread->id;
                }
            }
        }

        return $threadsWithNewMessages;
    }


    public function getCountNewMessages() {

        $userId = Auth::user()->id ;

        $countunreademsg = \DB::table('receivers')
                        ->where('toid', '=', $userId)
                        ->where('readed', '=', 'false')
                        ->count();

        return $countunreademsg ;
    }



}
