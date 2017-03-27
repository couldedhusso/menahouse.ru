<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use Validator;
use Redirect;
use Hash ;

use Auth;
use App\User ;
use App\Profiles;

use Illuminate\Database\QueryException ;
use Laracasts\Flash\Flash;

use Cache;

class SessionController extends Controller
{

  /*  function __construct(SignInForm $signInForm)
    {
        $this->signInForm = $signInForm ;
        $this->beforeFilter('guest');
    }*/
    public function __construct()
    {
        // $this->beforeFilter('guest', ['except' => 'destroy']);
    }

    /**
     * Show the form for signing.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return View('sessions.create');
    }


    public function UserAccountInfos()
    {
        $flag ='settings';

        $user = Auth::user();
        // dd($user);
        // $user = User::whereid(Auth::id())->first();
        $show_link = false;
        return view('sessions.settings-profil', compact('user', 'flag', 'show_link'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // fetch the form input
             $input = Input::only('email', 'password');
             $rules = [ 'email' => 'required', 'password' => 'required' ];

             // $input = Input::only('username', 'email', 'password');

             $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

             $credentials = [
                 'email' => Input::get('email'),
                 'password' => Input::get('password'),
                 'confirmed' => 1
             ];

             if (! Auth::attempt($credentials)) {
                 return Redirect('login_path')
                     ->withInput()
                     ->withErrors([
                         'credentials' => 'We were unable to sign you in.'
                     ]);
                } else {
                      return Redirect('me/obyavlenie');
             }

             ////

            // Flash::message('Welcome back!');

            //  return Redirect('sessions.dashboard');
    }


        /*   $formData = ['email' => $request->email,
                        'password' => $request->password];

        // validate the form
        //$this->signInForm->validate($formData);

        // if valid, then go back, if is valid - then try to sign in
        if (Auth::attempt($formData))
        {
             //  redirect to account page
             Flash::message('Добро пожаловать');
             return Redirect::intended('statuses');
        }
    }*/

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy()
    {
        Auth::logout();
        return Redirect('/');
    }


    /**
     * change auth informations email
     *
     */
    public function changeEmailUser()
    {
        $inputid = Input::get('user_id');
        $user = User::whereid($inputid)->first();

        try {
            $user->email = Input::get('email');
            $user->save();

            Flash::success('Логин успешно изменен !!');
            return view('sessions.settings-profil', compact('user'));
        } catch (QueryException $e) {
            if ($e->getcode() == 23000) {
                Flash::warning('такая элекьронная почта уже есть !!');
                return view('sessions.settings-profil', compact('user'));
                // dd(Input::get('email'));
            }
        }
    }

    /**
     * change auth informations -- password
     *
     */
    public function changePasswordUser()
    {
        $inputid = Input::get('user_id');
        $user = User::whereid($inputid)->first();
        $userprofile = Profiles::whereuser_id($inputid)->first();

        $credentials = [
          'email' => $user->email,
          'password' => Input::get('form-account-password-current'),
          'confirmed' => 1
        ];

        if (! Auth::attempt($credentials)) {
            Flash::warning('что-то не так, пароль свой проверайте пожалуйста  !!');
            return view('sessions.settings-profil', compact('user', 'userprofile'));
        } else {
            if (Input::get('form-account-password-new') == Input::get('form-account-password-confirm-new')) {
                $user->password = Hash::make(Input::get('form-account-password-new'));
                $user->save();

                Flash::success('Пароль успешно изменен  !!');
                return view('sessions.settings-profil', compact('user', 'userprofile'));
            } else {
                Flash::warning('что-то не так, проверайте пожалуйста подтверждение пароля !!');
                return view('sessions.settings-profil', compact('user', 'userprofile'));
            }
        }
    }
    //
    // public function setfilterValue(){
    //     $inputs = Input::all();
    //     dd($inputs);
    //     return json_decode($inputs);
    // }

    public function getfilterValue()
    {
        return 0 ;
    }

    public function UserInfos($id){

        if (Auth::user()->hasRole('Admin') || 
                Auth::user()->hasRole('Moderator')){

                    $flag ='settings';
                    $user =User::find($id);
                    $show_link = false;
                    return view('sessions.settings-profil', compact('user', 'flag', 'show_link'));
        }

        return redirect('/');
    }
}
