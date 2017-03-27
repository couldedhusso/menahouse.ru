<?php namespace Menahouse\Repositories;

use App\User;
use Menahouse\Contracts\UserInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UserRepository implements UserInterface
{

    public function Authenticated(){
        if (Auth::check()) {
            return true;
        }
        return false;
    }

    public function dataAuthUser(){
        if (Auth::check()) {
            return true;
        }
        
        return false;
    }


    public function storeUser($request){
        return true;
    }

      public function getuserById($id){

        try{
          $user = User::findOrFail($id);
        }
        catch(ModelNotFoundException $e){
             return null;
        }

        return $user;
       
    }




    
}
