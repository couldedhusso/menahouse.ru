<?php

namespace App\Http\Controllers;


//// TODO : refactoriser le client mail 
/// sur la base Mailer de laravel 

use Uuid;
use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\Sender;
use App\Receiver;
use App\Profiles;
use App\UserMessage;
use Carbon\Carbon;
use App\Images;
use App\Obivlenie;
use App\Policies\UserMessagePolicy;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image ;
use Illuminate\Filesystem\FileNotFoundException;

use Menahouse\Contracts\UserMailerInterface;

use DB;
use Gate;

use Menahouse\CustomHelper;



class UserMessageController extends Controller
{
    
    protected $dispatcher;
    protected $userMessageRepository;
    protected $policies;



    public function __construct(UserMailerInterface $msg, UserMessagePolicy $umspolicy){
        $this->dispatcher = app('Dingo\Api\Dispatcher');
        $this->userMessageRepository = $msg;
        $this->policies = $umspolicy;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show_link = false;
        $userid = Auth::user()->id;
        // $receivers = Receiver::wheretoid($userid)
        //                       ->lists('readed', 'msgid')
        //                       ->toArray();

        // recuperer ts les msges non lus, pas dans la liste de spams et non supprimes
        $receiverMsgId = Receiver::wheretoid($userid)
                                  ->where('spam', '=', '0')
                                  ->where('deleted', '=', '0')
                                  ->pluck('msgid')
                                  ->toArray();

        $usermessages = UserMessage::whereIn('id', $receiverMsgId)
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(4);

                                    // dd($usermessages);

        // foreach ($ums as $um) {
        //   if ($um->created_at > $receivers[$um->id]) {
        //       $newMessageCount[] = $um->id ;
        //   }
        // }
        //  $piece_jointes  = array();
        // foreach ($ums as $um) {
        //   if ($um->fichiers_joints == "1") {
        //     $piece_jointes[$um->id] = "true";
        //   } else {
        //     $piece_jointes[$um->id] = "false";
        //   }
          // if (! $receivers[$um->id]) {
          //     $newMessageCount[] = $um->id ;
          // }
        // }

        // dd(count($newMessageCount));
        $mailcount = count($usermessages);
        $flag = "inbox";
        return view('sessions.inbox', compact( 'mailcount','usermessages', 'userid', 'flag', 'show_link'));
    }

    public function usermail()
    {
            $userid = Auth::user()->id;

            // recuperer ts les msges non lus, pas dans la liste de spams et non supprimes

            // $usermessages =  DB::table('receivers')
            //     ->join('usermessages', 'receivers.toid', '=', 'usermessages.toid')
            //     ->join('senders', 'senders.userid', '=', 'usermessages.fromid')
            //     ->join('users', 'senders.userid', '!=', 'users.id')
            //     ->where('usermessages.toid', '=', $userid)
            //     ->where('receivers.spam', '=', '0')
            //     ->where('receivers.deleted', '=', '0')
            //     ->orderBy('receivers.created_at', 'desc')
            //     ->select('usermessages.*', 'users.imia as imia', 'users.familia as familia', 'receivers.readed  as isread')
            //     ->get();

            // TODO : user cant send message to themself

            $usermessages =  DB::table('usermessages')
                ->join('receivers', 'receivers.toid', '=', 'usermessages.toid')
                ->join('users', 'users.id', '=', 'usermessages.fromid')
                ->where('usermessages.toid','=', $userid)
                ->where('receivers.spam', '=', '0')
                ->where('receivers.deleted', '=', '0')
                ->select('usermessages.*','users.imia as imia', 'users.familia as familia', 'receivers.readed  as isread')
                ->get();

          return json_encode($usermessages);
    }

    public function usermailsenv($value='')
    {
        $messagesSent = UserMessage::where('fromid', '=', Auth::user()->id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return json_encode($messagesSent);
    }

    public function usermailstrash()
    {


        $messagesDel =  DB::table('usermessages')
                              ->join('receivers', 'receivers.toid', '=', 'usermessages.toid')
                              ->join('users', 'users.id', '=', 'usermessages.fromid')
                              ->where('usermessages.toid','=', Auth::user()->id)
                              ->where('receivers.spam', '=', '0')
                              ->where('deleted', '=', '1')
                              ->select('usermessages.*','users.imia as imia', 'users.familia as familia', 'receivers.readed  as isread')
                              ->get();
        return json_encode($messagesDel);
    }


    public function usermailspam()
    {
  
        $messagesDel =  DB::table('usermessages')
                              ->join('receivers', 'receivers.toid', '=', 'usermessages.toid')
                              ->join('users', 'users.id', '=', 'usermessages.fromid')
                              ->where('usermessages.toid','=', Auth::user()->id)
                              ->where('receivers.spam', '=', '1')
                              ->select('usermessages.*','users.imia as imia', 'users.familia as familia', 'receivers.readed  as isread')
                              ->get();
        return json_encode($messagesDel);
    }

    public function usermailsfavoris()
    {

        $messagesLiked =  DB::table('usermessages')
                              ->join('receivers', 'receivers.toid', '=', 'usermessages.toid')
                              ->join('users', 'users.id', '=', 'usermessages.fromid')
                              ->where('usermessages.toid','=', Auth::user()->id)
                              ->where('receivers.favoris', '=', '1')
                              // ->where('receivers.deleted', '=', '0')
                              ->select('usermessages.*','users.imia as imia', 'users.familia as familia', 'receivers.readed  as isread')
                              ->get();

        return json_encode($messagesLiked);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function sent()
    {
        $flag = "sent";
        $usermessages = $this->userMessageRepository->Sent();
        return view('messenger.sent', compact('flag', 'usermessages'));
    }

    public function trash()
    {
      $flag = "deleted";
      $usermessages = $this->userMessageRepository->Deleted();
      return view('messenger.deleted-msg', compact('flag', 'usermessages'));
    }

    public function liked(){

      $flag = "liked";
      $usermessages = $this->userMessageRepository->Liked();
      return view('messenger.liked', compact('flag', 'usermessages'));

    }

    public function compose($id, Request $request)
    {

        // dd($request);

        // $house = Obivlenie::whereid($id)->first();

        $house = getAppartInfos($id);

       // dd($house);

        if (null == $house)  return redirect()->back();

        $user = $request->user();
        // $umail = $user->email ;
        //$flag ="new";
        // return view('messenger.compose', compact('umail', 'flag'));

    
        // if (Gate::denies('isOwner', $user)){
        //     Session::flash('is_not_owner', 'nope');
        //     return redirect()->back();
        // }

        // dd(Gate::denies('canSend', [$user->id, $house->user_id]));

        // if (Gate::denies('canNotSend', $user->id, $house->user_id)){
        //     return redirect()->back();
        // }


        // if (Gate::denies('valid', $user->id)){
        //     return redirect('subscription-plan');
        // }

        $create_at = Date('Y-m-d', time());

        $typemsg = "Новое сообщение ";
       // $To = $house->owner;
        $flag ="compose";

        return view('messenger.compose', compact('house', 'typemsg', 'flag', 'create_at'));
    }


    public function reply($id){

        $reply = Usermessage::where(['id' => $id, 'toid' => Auth::id()])->first();
        if (!$reply || $reply->toid === Auth::id() ) return redirect()->back();

        $house = getAppartInfos($reply->id_obivlenie);

        if (null == $house)  return redirect()->back();

        $create_at = Date('Y-m-d', time());

        $typemsg = "Новое сообщение ";
        // $To = $house->owner;
        $flag ="compose";

        return view('messenger.compose', compact('house', 'typemsg', 'flag', 'create_at'));
    }


    public function create(Request $request)
    {

        $user = User::whereid(Auth::user()->id)->first();
        $umail = $user->email ;
        $flag ="new";
        return view('messenger.compose', compact('umail', 'flag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // TODO :
        //   1-recuperer les donees du cache de donnees
        //   2-envoie asynchrone de messsage

        

        $params = $request->all();


        // "subject" => "Квартира на Обмен продажа"
        // "id_obivlenie" => "1070"
        // "To" => "912"
        // "form-message" => "fngfd gfkkgjhkgfhjkgh;ksj; a hahjkd"

        if($this->policies->canNotSend($request->user()->id, 
                                          $params['To'])){
            return redirect()->back();
         }    

        $To = $params['To'];

        $sender = Auth::id();
        // $receiver = User::where('id', $To)->first();

        // if ($sender == $receiver->id) {
        //    return redirect()->back();
        // }

        // $conversation = Conversation::create(['subject' => Input::get('subject')]);
        $um = UserMessage::create([
                'uuid' => Uuid::generate(4)->string,
                'subject' => $params['subject'],
                'fromid' => $sender,
                'toid' => $To,
                'id_obivlenie' => $params['id_obivlenie'],
                'id_conversation' => $params['id_obivlenie'],
                'body' => $params['form-message']
            ]);

            $receiver = Receiver::create([
              'toid' => $To,
              'msgid' => $um->id,
              'last_read' => Carbon::now()
            ]);

            $sender = Sender::create([
              'userid' => $sender,
              'msgid' =>  $um->id
            ]);

        // try
        // {
        //     // authoriser uniquement les personnes qui ont des apparts a echanger entre elles
        //     $haveHouse = obivlenie::whereuser_id($sender)->firstOrFail();

            
        // }
        // catch (ModelNotFoundException $e){

        //     Session::flash('flash_message', 'Чтобы писать владельцу
        //                                     надо иметь квартиру.');
        //     return redirect()->back();
        // }


       // ==== TO DO : inbox
       return redirect('mailbox/inbox');
    }

    /**
     * Shows a message thread
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {


        $usermessage = Usermessage::where(['id' => $id])->first();

        if (!$usermessage) return redirect()->back();

        $house = getAppartInfos($usermessage->id_obivlenie);

       //dd($house);

        // si le message est destine a l user alors marquer comme lu et
        // afficher le message

        $user = Auth::id();

        if ( $user == $usermessage->toid) {
            $usermessage->markAsRead($user, $id);
        }

        $flag = "show";
        return view('messenger.show', compact('usermessage', 'house', 'flag'));
    //  }

      ///return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Receivers::wheremsgid($id)->first();
        $user->deleted = true;

        return redirect('messages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Returns all of the latest threads by updated_at date
     *
     * @return mixed
     */
    public static function getAllLatest()
    {
        return self::latest('updated_at');
    }


        //    Route::get('message/compose/{id}', function($id){

        //               dd($id);

        //               $user = Auth::user() ;
        //               $house = Obivlenie::whereid($id)->first();

        //               if (null == $house)  return redirect('mailbox/inbox');

        //               $typemsg = "Новое сообщение ";
        //               $To = $house->user_id;
        //               $flag ="compose";

        //               return view('messenger.compose', compact('house', 'To','typemsg', 'flag'));


        //           // if ($ch->getUserPlanPass($user)) {
        //           //     $house = Obivlenie::whereid($id)->first();
        //           //     $typemsg = "Новое сообщение ";
        //           //     $To = $house->user_id;
        //           //     $flag ="compose";
        //           //
        //           //     return view('messenger.compose', compact('house', 'To','typemsg', 'flag'));
        //           // }
        //           //
        //           // return redirect()->back();
        //       });
}
