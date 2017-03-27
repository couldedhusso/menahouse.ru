<?php namespace Menahouse\Repositories;

use Uuid;
use DB;
use Auth;
use Cache;
use App\User;
use Carbon\Carbon;
use App\Obivlenie;
use App\UserMessage;

use Menahouse\Contracts\UserMailerInterface;


class UserMailerRepository implements UserMailerInterface
{
    public function Inbox(){

        $userid = Auth::id();

        $cacheKey = 'usermsg'.$userid;
        $minutes = Carbon::now()->addMinutes(10);


        return DB::table('usermessages')->join('receivers', 'receivers.toid','usermessages.toid')
                                    ->where('receivers.spam', '0')
                                    ->where('receivers.deleted', '0')
                                    ->where('receivers.toid', Auth::id())
                                    ->orderBy('usermessages.created_at', 'desc')
                                    ->paginate(10);


        // return Cache::remember($cacheKey,  $minutes, function() use($userid){

        //     DD::table('usermessages')->join('receivers', 'receivers.toid','usermessages.toid')
        //                             ->where('receivers.spam', '0')
        //                             ->where('receivers.deleted', '0')
        //                             ->orderBy('created_at', 'desc')
        //                             ->paginate(10);
        //      });

    }


    public function Sent(){

        return DB::table('usermessages')->join('senders', 'senders.userid', '=', 'usermessages.fromid')
                                    ->join('users', 'users.id', '=', 'usermessages.fromid')
                                    ->where('usermessages.fromid','=', Auth::id())
                                    ->select('usermessages.*', 'users.imia', 'users.otchestvo')
                                    ->orderBy('usermessages.created_at', 'desc')
                                    ->paginate(10);
    }

    public function Liked(){

        return DB::table('usermessages')
                              ->join('receivers', 'receivers.toid', '=', 'usermessages.toid')
                              ->join('users', 'users.id', '=', 'usermessages.toid')
                              ->where('usermessages.toid','=', Auth::id())
                              ->where('receivers.favoris', '=', '1')
                              ->select('usermessages.*', 'users.imia', 'users.otchestvo')
                              // ->where('receivers.deleted', '=', '0')
                              ->orderBy('usermessages.created_at', 'desc')
                              ->paginate(10);

    }

    public function Deleted(){

        return  DB::table('usermessages')
                              ->join('receivers', 'receivers.toid', '=', 'usermessages.toid')
                              ->join('users', 'users.id', '=', 'usermessages.toid')
                              ->where(['usermessages.toid' => Auth::id(), 'receivers.deleted' =>  '1'])
                              ->select('usermessages.*', 'users.imia', 'users.otchestvo')
                              ->orderBy('usermessages.created_at', 'desc')
                              ->paginate(5);

    }

    public function markAsReaded(){



    }
}



// <?php

// namespace App\Http\Controllers;


// //// TODO : refactoriser le client mail 
// /// sur la base Mailer de laravel 


// use Illuminate\Http\Request;
// use App\User;
// use App\Conversation;
// use App\Sender;
// use App\Receiver;
// use App\Profiles;
// use App\UserMessage;

// use App\Images;
// use App\Obivlenie;

// use App\Http\Requests;
// use App\Http\Controllers\Controller;
// use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Input;
// use Illuminate\Support\Facades\Session;

// use Illuminate\Support\Facades\File;
// use Intervention\Image\Facades\Image ;
// use Illuminate\Filesystem\FileNotFoundException;

// use DB;

// use Menahouse\CustomHelper;


// class UserMessageController extends Controller
// {
    
//     protected $dispatcher;

//     public function __construct(){
//         $this->dispatcher = app('Dingo\Api\Dispatcher');
//     }
    
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//         $show_link = false;
//         $userid = Auth::user()->id;
//         // $receivers = Receiver::wheretoid($userid)
//         //                       ->lists('readed', 'msgid')
//         //                       ->toArray();

//         // recuperer ts les msges non lus, pas dans la liste de spams et non supprimes
//         $receiverMsgId = Receiver::wheretoid($userid)
//                                   ->where('spam', '=', '0')
//                                   ->where('deleted', '=', '0')
//                                   ->pluck('msgid')
//                                   ->toArray();

//         $usermessages = UserMessage::whereIn('id', $receiverMsgId)
//                                     ->orderBy('created_at', 'desc')
//                                     ->get();

//         // foreach ($ums as $um) {
//         //   if ($um->created_at > $receivers[$um->id]) {
//         //       $newMessageCount[] = $um->id ;
//         //   }
//         // }
//         //  $piece_jointes  = array();
//         // foreach ($ums as $um) {
//         //   if ($um->fichiers_joints == "1") {
//         //     $piece_jointes[$um->id] = "true";
//         //   } else {
//         //     $piece_jointes[$um->id] = "false";
//         //   }
//           // if (! $receivers[$um->id]) {
//           //     $newMessageCount[] = $um->id ;
//           // }
//         // }

//         // dd(count($newMessageCount));
//         // $mailcount = count($usermessages);
//         $flag = "inbox";
//         return view('sessions.inbox', compact( 'mailcount', 'userid', 'flag', 'show_link'));
//     }

//     public function usermail()
//     {
//             $userid = Auth::user()->id;

//             // recuperer ts les msges non lus, pas dans la liste de spams et non supprimes

//             // $usermessages =  DB::table('receivers')
//             //     ->join('usermessages', 'receivers.toid', '=', 'usermessages.toid')
//             //     ->join('senders', 'senders.userid', '=', 'usermessages.fromid')
//             //     ->join('users', 'senders.userid', '!=', 'users.id')
//             //     ->where('usermessages.toid', '=', $userid)
//             //     ->where('receivers.spam', '=', '0')
//             //     ->where('receivers.deleted', '=', '0')
//             //     ->orderBy('receivers.created_at', 'desc')
//             //     ->select('usermessages.*', 'users.imia as imia', 'users.familia as familia', 'receivers.readed  as isread')
//             //     ->get();

//             // TODO : user cant send message to themself

//             $usermessages =  DB::table('usermessages')
//                 ->join('receivers', 'receivers.toid', '=', 'usermessages.toid')
//                 ->join('users', 'users.id', '=', 'usermessages.fromid')
//                 ->where('usermessages.toid','=', $userid)
//                 ->where('receivers.spam', '=', '0')
//                 ->where('receivers.deleted', '=', '0')
//                 ->select('usermessages.*','users.imia as imia', 'users.familia as familia', 'receivers.readed  as isread')
//                 ->get();

//           return json_encode($usermessages);
//     }

//     public function usermailsenv($value='')
//     {
//         $messagesSent = UserMessage::where('fromid', '=', Auth::user()->id)
//                                     ->orderBy('created_at', 'desc')
//                                     ->get();

//         return json_encode($messagesSent);
//     }

//     public function usermailstrash()
//     {


//         $messagesDel =  DB::table('usermessages')
//                               ->join('receivers', 'receivers.toid', '=', 'usermessages.toid')
//                               ->join('users', 'users.id', '=', 'usermessages.fromid')
//                               ->where('usermessages.toid','=', Auth::user()->id)
//                               ->where('receivers.spam', '=', '0')
//                               ->where('deleted', '=', '1')
//                               ->select('usermessages.*','users.imia as imia', 'users.familia as familia', 'receivers.readed  as isread')
//                               ->get();
//         return json_encode($messagesDel);
//     }


//     public function usermailspam()
//     {
  
//         $messagesDel =  DB::table('usermessages')
//                               ->join('receivers', 'receivers.toid', '=', 'usermessages.toid')
//                               ->join('users', 'users.id', '=', 'usermessages.fromid')
//                               ->where('usermessages.toid','=', Auth::user()->id)
//                               ->where('receivers.spam', '=', '1')
//                               ->select('usermessages.*','users.imia as imia', 'users.familia as familia', 'receivers.readed  as isread')
//                               ->get();
//         return json_encode($messagesDel);
//     }

//     public function usermailsfavoris()
//     {

//         $messagesLiked =  DB::table('usermessages')
//                               ->join('receivers', 'receivers.toid', '=', 'usermessages.toid')
//                               ->join('users', 'users.id', '=', 'usermessages.fromid')
//                               ->where('usermessages.toid','=', Auth::user()->id)
//                               ->where('receivers.favoris', '=', '1')
//                               // ->where('receivers.deleted', '=', '0')
//                               ->select('usermessages.*','users.imia as imia', 'users.familia as familia', 'receivers.readed  as isread')
//                               ->get();

//         return json_encode($messagesLiked);
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */

//     public function sent()
//     {
//       $flag = "sent";
//       return view('messenger.sent', compact('flag'));
//     }

//     public function trash()
//     {
//       $flag = "deleted";
//       return view('messenger.deleted-msg', compact('flag'));
//     }

//     public function liked(){

//       $flag = "liked";
//       return view('messenger.liked', compact('flag'));

//     }
//     public function create()
//     {
//         $user = User::whereid(Auth::user()->id)->first();
//         $umail = $user->email ;
//         $flag ="new";
//         return view('messenger.compose', compact('umail', 'flag'));
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {

//         // TODO :
//         //   1-recuperer les donees du cache de donnees
//         //   2-envoie asynchrone de messsage

//         $To = Input::get('To');

//         $sender = Auth::user()->id;
//         $receiver = User::whereid(Input::get('To'))->first();


//         if ($sender == $receiver->id) {
//            return redirect()->back();
//         }

//         try
//         {
//             // authoriser uniquement les personnes qui ont des apparts a echanger entre elles
//             $haveHouse = obivlenie::whereuser_id($sender)->firstOrFail();

//             // $conversation = Conversation::create(['subject' => Input::get('subject')]);
//             $um = UserMessage::create([
//                 'uuid' => Uuid::generate(4)->string,
//                 'subject' => Input::get('subject'),
//                 'fromid' => $sender,
//                 'toid' => $To,
//                 'id_obivlenie' => Input::get('id_obivlenie'),
//                 'id_conversation' => Input::get('id_obivlenie'),
//                 'body' => Input::get('form-message')
//             ]);

//             $receiver = Receiver::create([
//               'toid' => Input::get('To'),
//               'msgid' => $um->id,
//               'last_read' => Carbon::now()
//             ]);

//             $sender = Sender::create([
//               'userid' => $sender,
//               'msgid' =>  $um->id
//             ]);
//         }
//         catch (ModelNotFoundException $e){

//             Session::flash('flash_message', 'Чтобы писать владельцу
//                                             надо иметь квартиру.');
//             return redirect()->back();
//         }


//        // ==== TO DO : inbox
//        return redirect('mailbox/inbox');
//     }

//     /**
//      * Shows a message thread
//      *
//      * @param $id
//      * @return mixed
//      */
//     public function show($id)
//     {

//         $user = Auth::user();

//         $ch = new CustomHelper ;

//       //  if ($ch->getUserPlanPass($user)) {


//         try {
//             $usermessage = UserMessage::whereid($id)->first();

//         } catch (ModelNotFoundException $e) {
//             Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
//             return redirect('messages');
//         }

//         // $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();
//         // $ = Profiles::whereuser_id($userId)->first();
//         $house = Obivlenie::where('id', '=', $usermessage->id_conversation)
//                                                             ->with('images')
//                                                             ->first();


//         // si le message est destine a l user alors marquer comme lu et
//         // afficher le message
//         if ($user->id == $usermessage->toid) {
//           $usermessage->markAsRead($user->id, $id);
//         }
//         $flag = "show";
//         return view('messenger.show', compact('usermessage', 'house', 'flag'));
//     //  }

//       ///return redirect()->back();
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
//         $user = Receivers::wheremsgid($id)->first();
//         $user->deleted = true;

//         return redirect('messages');
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         //
//     }

//     /**
//      * Returns all of the latest threads by updated_at date
//      *
//      * @return mixed
//      */
//     public static function getAllLatest()
//     {
//         return self::latest('updated_at');
//     }
// }
