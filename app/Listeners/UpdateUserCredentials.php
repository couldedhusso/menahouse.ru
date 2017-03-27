<?php

namespace App\Listeners;

use App\Events\ReportAbuseWasPosted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\UserWasBanned;

use App\Plainte;
use App\Obivlenie;
use App\UserMessage;
use App\BlackList;

use DB;

class UpdateUserCredentials
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
     * @param  ReportAbuseWasPosted  $event
     * @return void
     */
    public function handle(ReportAbuseWasPosted $event)
    {
        // dd($event);
          $plaintes = $this->nbrPlaintesByUser($event->user->id);
          event(new UserWasBanned($event->user));

        if (5 == $plaintes->nbr_plaintes) {
            $event->user->status = 'banned';
            $this->getUpdateUserAdvertsInfos($event->user->id);
            $this->deleteSentMesagesByUser($event->user->id);
            $event->user->save();

            event(new UserWasBanned($event->user));

        } elseif (2 == $plaintes->nbr_plaintes) {

            $block = BlackList::create([
                'user_id' => $event->user->id,
                'user_block_id' => $event->donnees->plaignant,
                'unlock_user' => 0
            ]);

            $event->user->status = 'blocked';
            $event->user->save();
        }

         return true;
    }

    private function nbrPlaintesByUser($id)
    {

         return DB::table('plaintes')->select(DB::raw('count(*) as nbr_plaintes'))
                           ->where('auteur_faits', $id)
                           ->first() ;
    }

    private function getUpdateUserAdvertsInfos($id)
    {

        return DB::table('obivlenie')->where('user_id', $id)
                                  ->update('available', 0) ;
    }

    private function deleteSentMesagesByUser($id)
    {

          return DB::table('usermessages')->where('fromid', $id)
                                         ->delete() ;
    }
}
