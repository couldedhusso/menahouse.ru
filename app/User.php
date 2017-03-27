<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;



class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Traits\Messagable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['familia', 'imia', 'otchestvo', 'name','email', 'password',
                           'phonenumber', 'confirmation_code', 'status',
                           'payload', 'billing', 'uuid'];

    // status == par exemple user bloque

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'billing'];

    public static $rules = [
        'email'                 => 'required|email|unique:users',
        'phonenumber'           => 'required|email|unique:users',
        'password'              => 'required|min:6|max:20',
        'password_confirmation' => 'required|same:password'
    ];

    public static $messages = [

        'email.required'        => 'Email is required',
        'email.email'           => 'Email is invalid',
        'password.required'     => 'Password is required',
        'password.min'          => 'Password needs to have at least 6 characters',
        'password.max'          => 'Password maximum length is 20 characters'
    ];


    public function profile()
    {
       return $this->hasOne('App\Profiles');
    }

    public function subscription()
    {
        return $this->hasOne('App\Subscription');
    }

    public function roles()
    {
      return $this->belongsToMany('App\Role');
    }

    public function obivlenie()
    {
        /**
       * Get all of the houses for the user.
       */
        return $this->hasMany('App\Obivlenie');
    }


    public function nedvizhimosts()
    {
        /**
       * Get all of the houses for the user.
       */
        return $this->hasMany('App\Nedvizhimosts');
    }

    public function hasRole($name)
    {
      foreach ($this->roles as $role)
      {
        if($role->name == $name ) return true ;
      }
      return false ;
    }

    public function assignRole($role)
    {
      return $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
      return $this->roles()-detach($role);
    }
    //
    // public function owns(Nedvizhimosts $nedvizhimosts){
    //   return $this->id == $nedvizhimosts->user_id ;
    // }
    //
    // public function canEdit (Nedvizhimosts $nedvizhimosts){
    //   return $this->owns($nedvizhimosts);
    // }

    public function owns(Obivlenie $obivlenie){
      return $this->id == $obivlenie->user_id ;
    }

    public function canEdit (Obivlenie $obivlenie){
      return $this->owns($obivlenie);
    }


    public function getUserId(){
       return $this->id ;
    }

    /**
     * Get all of the subscriptions for the Stripe model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function subscriptions()
    {
        return $this->hasMany('App\Subscription')->orderBy('created_at', 'desc');
    }

}
