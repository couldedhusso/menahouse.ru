<?php namespace Menahouse\Repositories;

use DB;
use Cache;
use App\User;
use App\BlackList;
use App\Subscription;
use Session;


/**
 * 
 */
class PolicyRepository 
{
    public function canWrite($from, $to){

        
        // $blocked = DB::table('blocks')->where(['user_id' => $to,  'user_block_id' => $from])
        //                              ->select('unlock_user')->first();

        // return $blocked ;


         $blocked = BlackList::where(['user_id' => $to,  'user_block_id' => $from])
                                    ->first();
        
         
         if ($blocked && $blocked->unlock_user){

                  return true;
          }

        return  false ;
    }


    public function canNotSendMessage($from, $to){


         $blocked = BlackList::where(['user_id' => $to,  'user_block_id' => $from])
                                        ->first();

        //  return $blocked && $blocked->unlock_user;

         if ($blocked && $blocked->unlock_user){

                  return true;
          }

        return  false ;

        // return $blocked ;
    }

    public function Subscribed($from){

        
        $subscription = Subscription::where(['user' => $from])->first();

        if($subscription && $subscription->onValidPeriod()){

              return true;
        }

        return  false;

        // return $blocked ;
    }


    public function isOwner($user){

       //  TODO :: Voir s il est possible d utiliser un systeme de softdelete pour empecher
       //  qu un user enregistre plusieur appart en supprimant les anciens


        /// ====== forever remember cache 

        $key = 'policy-is-owner'.$user->id ;
        $minutes = 10;

        $appart = Cache::remember($key , $minutes, function() use($user) {
            return DB::table('obivlenie')->where('user_id', $user->id)
                                       ->first();
        });

        if ($appart){
            return true ; /// utilisateur a deje un appart dans notre bd;
        }
        
        return false ;
    }

    public function wasBanned($authuser){

        $key = 'policy-was-banned'.$authuser->id ;
        $minutes = 10;

        $user = Cache::remember($key , $minutes, function() use($authuser) {
            return DB::table('users')->where('id', $authuser->id)
                                    ->select('status')->first();
        });

        // dd($user->status);

        if ('banned' == $user->status) {
            return true ;
        }

        return false ;

    }


    public function canUpdate($user){

        return $this->wasBanned($user);
        
    }



}
