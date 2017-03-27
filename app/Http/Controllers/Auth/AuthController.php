<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Traits\CaptchaTrait;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    protected $redirectTo = 'me/obyavlenie';
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'phonenumber' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

      $confirmation_code = str_random(30);
      $email = $data['email'];

      list($familia, $imia, $otchestvo) = explode(" ", $data['fio']);
      // dd($data['fio']);

      // return User::create([
      //     'name' => $data['name'],
      //     'email' => $data['email'],
      //     'password' => bcrypt($data['password']),
      // ]);

      $user = User::create([
              'familia' => $familia,
              'imia' => $imia,
              'otchestvo' => $otchestvo,
              'phonenumber' => $data['phonenumber'],
              'email' => $email,
              'password' => bcrypt($data['password']),
              'confirmation_code' => $confirmation_code
        ]);

      $arrayData = array('confirm_cod' => $confirmation_code);

      // Mail::send('mails.verify', $arrayData, function($message)
      //                           use( $confirmation_code)
      // {
      //      $message->to($data['email'], $imia + " "+ $otchestvo )
      //          ->subject('Verify your email address');
      // });

      $email = $data['email'];
      return view('pages.thank_you', compact('email'));

    }
}
