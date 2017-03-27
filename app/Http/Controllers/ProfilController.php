<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exception;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image ;

use App\Images;
use App\User;
use App\Profiles;
use Menahouse\CustomHelper;

use Storage;

use Auth;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {


        $user = Auth::user();
        $id = Input::get('user_id');

        // $Helper = new CustomHelper;
        // $StoragePath = $Helper->getStorageDirectory();

        // $id = Input::get('user_id');
        // $user = User::find($id);
        // $profile = Profiles::whereuser_id($id)->first();

       // mettre a jour le statut de l user 
       
       if ($user->hasRole('Admin'))
       {

           $status = 'Activated';

           if (Input::get('account-status') == 'Заблокированный'){
             $status = 'Banned';
           }

           $user_upd = User::where('id',  $id)->update(['status' => $status]);

           return redirect()->back();

       }


       
       $name = explode(" ", trim(Input::get('fio')));

     // dd($name[0]);

     //===========    TODO : bug sur l edit

     

      if ($this->isCurrent($id) ) {

        // TODO : A refactoriser

        $name = explode(" ", trim(Input::get('fio')));
        switch (count($name)) {
          case 1:

            $user->familia = $name[0];
            $user->save();
            break;

          case 2:


              $user->familia = $name[0];
              $user->imia = $name[1];
              $user->save();
            break;

          default:

            // dd($name);

            $user->update(['familia' => $name[0], 'imia' => $name[1], 
                            'otchestvo' => $name[2]]);
            // $user->familia = ;
            // $user->imia = $name[1];
            // $user->otchestvo = $name[2];
            $user->save();
            break;
        }

          $phonenumber = Input::get('form-account-phone');
          $email = Input::get('form-account-email');

          if (!empty($phonenumber)) {
            $user->phonenumber = $phonenumber;
            $user->save();
          }

          if (!empty($email)) {
            $user->email = $email;
            $user->save();
          }

          return Redirect('me/account/');

      }



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

    public function isCurrent($id){
      return ( Auth::user()->id == $id );
    }

    // public function savepic($img, $filename){

    //     $storage_path = public_path().'/storage/profil/' ;


    //     if(! File::exists($storage_path)) {
    //         File::makeDirectory($storage_path);
    //     }

    //     // $img->resize(200, 200);
    //     // $img->save($storage_path.$filename);

    //     $img->move($storage_path, $filename);
    // }

    // public function deletepic($filename){
    //     $pic =  public_path().'/storage/profil/'.$filename ;
    //     if(File::exists($pic)){
    //         File::delete($pic);
    //     }
    // }
}
