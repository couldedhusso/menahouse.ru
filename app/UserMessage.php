<?php

namespace App;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model as Eloquent;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image ;
use App\Receiver;
use App\Sender;

use Carbon\Carbon;
use App\Profiles;
use DB;


class UserMessage extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usermessages';
    // protected $dates = [''];


    /**
     * The attributes that can be set with Mass Assignment.
     *
     * @var array
     */
    protected $fillable = ['id', 'fromid', 'toid', 'body', 'subject',
    'fchiers_joints', 'id_conversation', 'id_obivlenie', 'uuid'];

    /**
     * Validation rules.
     *
     * @var array
     */
     protected $rules = [
         'body' => 'required',
         'toid' => 'required',
         'fromid' => 'required',
     ];

    /**
     *  Notification of message
     *
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function  notification(){
        return $this->hasMany('App\Notification');
     }

     /**
      *  Notification of message
      *
      *  @return \Illuminate\Database\Eloquent\Relations\HasMany
      */
      public function  attachments(){
         return $this->hasMany('App\Attachments');
      }

      /**
       * Convertion relationship
       *
       * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
       */

      public function conversation()
      {
          return $this->belongsTo('App\Conversation');
      }

      /**
       * User relationship
       *
       * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
       */
      public function user()
      {
          return $this->belongsTo(Config::get('messenger.user_model'));
      }


      public function images()
      {
        return $this->morphMany('App\Images', 'imageable');
      }

      public function favorisutilisateurs()
      {
          return $this->morphMany('App\FavorisUtilisateurs', 'favorisutilisateurable');
      }


      /**
       * Mark a thread as read for a user
       *
       * @param integer $userId
       */
      public function markAsRead($userId, $msgid)
      {
          try {
              $receiver = $this->getReceiverByUserId($userId, $msgid);
              $receiver->last_read = new Carbon;
              $receiver->readed = true ;
              $receiver->save();

          } catch (ModelNotFoundException $e) {
              // do nothing
          }
      }

      /**
       * See if the current thread is unread by the user
       *
       * @param integer $userId
       * @return bool
       */
      public function isUnread($userId, $msgid)
      {
          try {
              $receiver = $this->getReceiverByUserId($userId, $msgid);
              if ($receiver->readed ) {
                  return true;
              }
              // if ($this->created_at > $receiver->last_read) {
              //     return true;
              // }
          } catch (ModelNotFoundException $e) {
              // do nothing
          }

          return false;
      }


      /**
       * favorites msg user
       *
       * @param integer $userId
       */

      public function markAsDelete($userId, $msgid)
      {
          try {
              $receiver = $this->getReceiverByUserId($userId, $msgid);
              $receiver->deleted = true ;
              $receiver->save();

          } catch (ModelNotFoundException $e) {
              // do nothing
          }
      }
      
    //   public function setCreatedAtAttribute( $value ) {
    //     $this->attributes['created_at'] = (new Carbon($value))->format('Y-m-d');
    //   }

      /**
       * not favorites msg for user
       *
       * @param integer $userId
       */

      public function isDeleted($userId, $msgid)
      {
          try {
              $receiver = $this->getReceiverByUserId($userId, $msgid);

              if ($receiver->deleted ) {
                  return true;
              }
          } catch (ModelNotFoundException $e) {
              // do nothing
          }

          return false;
      }


      /**
       * Finds the participant record from a user id
       *
       * @param $userId
       * @return mixed
       * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
       */
      public function getReceiverByUserId($userId, $msgid){
          $user = Receiver::where('toid', '=', $userId)
                          ->where('msgid', '=', $msgid)
                          ->firstOrFail();
          return $user ;
      }

      /**
       * Finds the participant record from a user id
       *
       * @param $userId
       * @return mixed
       * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
       */
      public function getParticipantFromUser($userId)
      {
          return $this->participants()->where('user_id', $userId)->firstOrFail();
      }

      public function getCountNewMessages($userId) {

          $newMessageCount = [] ;
          $receivers = Receiver::wheretoid($userid)
                                ->lists('last_read', 'msgid')
                                ->toArray();

          $ums = UserMessage::wheretoid($userid)
                                      ->orderBy('id', 'desc')
                                      ->get();

          foreach ($ums as $um) {
              if ($um->updated_at >= $receivers[$um->id]) {
                  $newMessageCount[] = $um->id ;
              }
          }

          return $newMessageCount ;

      }

      public function getSenderInfos($senderId){

          $sender = User::where('id', '=', $senderId)->first();

          // $sender = \DB::table('profiles')
          //   ->where('user_id', '=', $senderId)
          //   ->join('users', 'profiles.user_id', '=', 'users.id')
          //   ->join('images', 'profiles.id', '=', 'images.imageable_id')
          //   ->first();

          // $sender = Profiles::whereuser_id($senderId)->->first();
          return $sender->imia.' '.$sender->familia ;
      }


}
