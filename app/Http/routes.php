<?php

use App\Role ;
use App\Obivlenie ;
use App\Categorie ;
use App\Images ;
use App\Profiles;
use App\User;
use App\Receiver;
use App\Subscription;
use App\FavorisUtilisateurs;

use App\Bookmarked;
use App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\UserMessage;
use Illuminate\Support\Collection ;
use Carbon\Carbon;
use Menahouse\CustomHelper;
use Menahouse\MenahouseSearchEngine;


// use Request;
// use Validator;


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/// TODO : A refactoriser avec une regex 
Route::group(['prefix' => 'obmen-prodazha'], function () {

    Route::get('moskva/{name}={id}', 'ObivlenieController@detailsAppart')
    ->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

    Route::get('moskovskaya-oblast/{name}={id}', 'ObivlenieController@detailsAppart'
    )->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

    Route::get('novaya-moskva/{name}={id}', 'ObivlenieController@detailsAppart')
    ->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

});


Route::get('no-appart-notification', function(Request $request){

     $request->session()->flash('is_not_owner', 'Oops!');
     return redirect()->back();

    // if (Gate::denies('canwrite', $request->user()->id)){
               
    // }
});

Route::get('auth-notification', function(Request $request){
    $request->session()->flash('is_not_auth', 'Oops!');
     return redirect()->back();
});

Route::group(['prefix' => 'obmen'], function () {

    Route::get('moskva/{name}={id}', 'ObivlenieController@detailsAppart')
    ->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

    Route::get('moskovskaya-oblast/{name}={id}', 'ObivlenieController@detailsAppart'
    )->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

    Route::get('novaya-moskva/{name}={id}', 'ObivlenieController@detailsAppart')
    ->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

});


Route::group(['middleware' => 'auth'], function () {

    //  Route::group(['prefix => me'], function () {

        Route::get('support/obyavlenie/{id}', 'ObivlenieController@getUserObyavlenieBySupport');
        Route::get('support/user/{id}', 'SessionController@UserInfos');

        Route::get('me/account', 'SessionController@UserAccountInfos');
        Route::get('me/account', 'SessionController@UserAccountInfos');
        Route::get('me/obyavlenie', 'ObivlenieController@getUserObyavlenie');
        Route::get('me/rasmestit-obyavlenie', 'ObivlenieController@index');
        Route::get('me/udalit-obyavlenie', 'ObivlenieController@destroy');
        Route::get('me/redaktirovat-obyavlenie', 'ObivlenieController@destroy');

        Route::get('me/favorites/obyavlenie', 'ObivlenieController@getUserFavoris');

        Route::get('me/restore-account', 'AbuseReportController@restoreAccount');
        Route::get('me/zhaloba/{id}', 'AbuseReportController@complaintForm');

        Route::post('me/restore-account', 'AbuseReportController@restore');
        Route::post('me/zhaloba', 'AbuseReportController@plaintesUser');

        
        // Route::get('{action}={param}', 'UserMessageController@index')
        //      ->where(['action' => '[a-z]+', 'param' => '[a-z]+']);


        // Route::group(['prefix => mail'], function () {

        //      ['action'=> 'mail', 'param' => ['inbox', 'sent', 'compose', 'reply']]; 
        // });
         
    // });

    Route::get('subscription-plan', function(){

      return View('pages.subscription-plan');
    });

    Route::get('dashboard/advertisements', function(){

        $userId = Auth::user()->id ;
        $flag = 'advertisements';
        $show_link = true;
    //    $obivlenie = obivlenie::whereuser_id($userId)->get();
        $obivlenie = obivlenie::whereuser_id($userId)->where('available','=','1')
                                                     ->with('images')
                                                     ->get();

        return View('sessions.dashboard', compact('flag', 'obivlenie', 'show_link'));
    });

    Route::get('dashboard/advertisement/add', 'ObivlenieController@new');

    Route::get('dashboard/advertisement/delete/{id}', ['as' => 'path_delete_item',
                        'uses' => 'ObivlenieController@destroy']);

    Route::get('dashboard/bookmarked/delete/{id}', 'ObivlenieController@destroyObj');

    Route::get('dashboard/advertisement/edit/{id}', function ($id)    {

        $house = DB::table('obivlenie')->whereid($id)->first();

        if (null == $house) return redirect('/');

        return View('sessions.update-item', compact('house', 'id')) ;
    });

    Route::get('dashboard/advertisement/edit', ['as' => 'path_update_item',
                        'uses' => 'ObivlenieController@update']);

    Route::post('dashboard/advertisement/edit', 'ObivlenieController@update');

    Route::post('dashboard/bookmarked/', 'FavorisUtilisateurController@bookmarkItem');

    Route::get('dashboard/bookmarked/', 'FavorisUtilisateurController@getBookmarkItemUser');



    Route::get('getuserbookmarkedproperties', function()
    {
        $userId = Auth::user()->id ;

        // $results = DB::select( DB::raw("SELECT * FROM some_table WHERE some_col = :somevariable"), array(
        //    'somevariable' => $someVariable,
        // ));


        // $houses =

        // ->selectR("obivlenie.*, bookmarked.id as bkm_id, DATE_FORMAT('bookmarked.created_at', '%d/%l/%Y')  as bkm_date")

        return response()->json(
            DB::table('bookmarked')
            ->join('obivlenie', 'bookmarked.obivlenie_id', '=', 'obivlenie.id')
            ->join('users', 'users.id', '=', 'bookmarked.user_id')
            ->select('obivlenie.*', 'bookmarked.id as bkm_id', 'bookmarked.created_at as bkm_date')
            ->get()
          );
    });

    // Route::get('dashboard/bookmarked', function (){


    //     $flag = 'bookmarked';
    //     $show_link = true;

    //     return View('sessions.bookmarked', compact('flag', 'show_link'));
    // });

    /* Route::get('dashboard/advertisement/add', function ()    {
        return View('sessions.additem') ;
    }); */



    Route::post('additems', ['as' => 'additem_path',
                       'uses' => 'ObivlenieController@store']);

    Route::post('message/reply', ['as' => 'reply_msg',
                                          'uses' => 'UserMessageController@store']);

    Route::post('message/udalenie', ['as' => 'delete_msg',
                                  'uses' => 'UserMessageController@update']);

    Route::group(['prefix' => 'mailbox'], function () {

          Route::get('usermail', 'UserMessageController@usermail');
          Route::get('usermailsenv', 'UserMessageController@usermailsenv');
          Route::get('usermailstrash', 'UserMessageController@usermailstrash');
          Route::get('usermailsfavoris', 'UserMessageController@usermailsfavoris');

          Route::get('inbox', ['as' => 'messages', 'uses' => 'UserMessageController@index']);



          Route::group(['middleware' => 'mailboxacces'], function (){

              Route::get('message/compose/{id}', 'UserMessageController@compose');
              Route::get('message/{id}/reply', 'UserMessageController@reply');
            
            //   Route::get('message/reply/{fromid}/{houseid}', function($fromid, $houseid){
            //       // $sender =  User::where('id', '=', Auth::user()->id )->first();
            //       // $usrmsge = $msgparams->usrmsge;
            //       // $receiver = $usrmsge->fromid;

                  
            //       $typemsg = "Ответ на сообщение";
            //       $To = $fromid;

            //       if ($fromid != Auth::user()->id ) {

            //         $house = Obivlenie::whereid($houseid)->with('images')->first();
            //         $user = User::where('id', $fromid)->first();


            //         // TODO : A refactoriser

            //         if (null == $user) return redirect('/mailbox/inbox');
                    
            //         if (null == $house) return redirect('/mailbox/inbox');

            //         $typemsg = "Ответ на сообщение ";
            //         $flag = "compose";
            //         $create_at = Date('Y-m-d', time());
            //         return view('messenger.compose', compact('house', 'typemsg', 'create_at','To', 'flag'));
            //       }

            //       return redirect('/mailbox/inbox');

            //   });

              Route::get('message/sent', ['as' => 'messages.sent', 'uses' => 'UserMessageController@sent']);
              Route::get('message/trash', ['as' => 'messages.trash', 'uses' => 'UserMessageController@trash']);
              Route::get('message/liked', ['as' => 'messages.liked', 'uses' => 'UserMessageController@liked']);
              Route::get('message/{id}', ['as' => 'messages.show', 'uses' => 'UserMessageController@show']);
              Route::post('message/compose', ['as' => 'messages.store', 'uses' => 'UserMessageController@store']);
              Route::put('inbox/{id}', ['as' => 'messages.update', 'uses' => 'UserMessageController@update']);

              Route::get('message/trash/{idmsg}', function($idmsg){
                $receiverMsg = Receiver::wheretoid(Auth::user()->id)
                                          ->where('msgid', '=', $idmsg)
                                          ->update(array('deleted' => 1));

                return redirect('/mailbox/inbox');

              });

              Route::get('message/like/{idmsg}', function($idmsg){
                $receiverMsg = Receiver::wheretoid(Auth::user()->id)
                                          ->where('msgid', '=', $idmsg)
                                          ->update(array('favoris' => 1));

                return redirect('/mailbox/inbox');
              });

          });
    });


   ///  'profil/{id}'  ===>  'profil/me' == id = Auth::user()->id

    // Route::get('profil/edit/{id}', function($id){
    //   $user = User::whereid($id)->first();
    //   return view('sessions.edit-profil', compact('user'));

    // });

    // Route::get('dashboard/settings/{id}', function($id){
    //   // verifier si l user current est autorise a faire
    //   // ses modifs sinon retour a la page d acceuil
    //   $flag ='settings';
    //   if ($id == Auth::user()->id ) {

    //     $user = User::whereid($id)->first();
    //     $show_link = false;

    //     return view('sessions.settings-profil', compact('user',  'flag', 'show_link'));

    //   } else{

    //     return view('/');
    //   }
    // });

    Route::post('dashboard/settings', ['as' => 'dashboard.settings',
                       'uses' => 'ProfilController@edit']);

    Route::post('profil/edit', ['as' => 'profil_edit',
                       'uses' => 'ProfilController@edit']);

    Route::post('setting/edit/email', ['as' => 'email_edit',
                                'uses' => 'SessionController@changeEmailUser']);

    Route::post('setting/edit/password', ['as' => 'password_edit',
                                        'uses' => 'SessionController@changePasswordUser']);


  // ==== gestion des favoris utilisateurs
  Route::get('/add-item-to-bookmark/{id}', 'FavorisUtilisateurController@bookmarkItem');
  Route::post('/remove-item-to-bookmark', 'FavorisUtilisateurController@removeItem');

  Route::post('/remove-item-to-bookmark', 'FavorisUtilisateurController@removeItem');
  Route::post('/remove-item-to-bookmark', 'FavorisUtilisateurController@removeItem');


});  // end protected route



///====================> advertisements routes ================================

// TODO:
      // 1- regler le probleme de parametres de recherches
      // 2-changer les differentes urls suivant le modele
        //localhost:8000/kvartiri/odnokomnatnaya
        //localhost:8000/kvartiri/odnokomnatnaya

// new route for dashboard ==> nedvizhimosti
// ==> pedaktirovani-obivlenie
// ==> nastroiki/me


Route::resource('password_resets', 'PasswordResetController');


Route::get('nedvizhimost/{id}', function($id){

     $house = Obivlenie::whereid($id)->with('images')->first();

     if (Auth::check()) {
         $userID = Auth::user()->id;

         if ($userID != $house->user_id) {
           if ($house->numberclick != 0) {
             $numberclick = $house->numberclick;
             $numberclick += 1;
           } else {
             $numberclick = 1;
           }
           $house->numberclick = $numberclick ;
         } // ne pas prendre en compte les clicks du prioprio
     } else {
           if (($house->numberclick != null ) OR ($house->numberclick != 0)) {
             $numberclick = $house->numberclick;
             $numberclick += 1;
           } else {
             $numberclick = 1;
           }

           $house->numberclick = $numberclick ;
     }

     $house->save();
    return View('house.property_details', compact('house', 'id')) ;
 });

Route::get('property/number_of_rooms/{numberroom}', function($numberroom){


  if ($numberroom == 4 ) {
      $paramSearch = array(
        'kolitchestvo_komnat' => '4',
        'typerequest' => '1'
      );

  } else {
      $paramSearch = array('kolitchestvo_komnat' => $numberroom, 'typerequest' => '3');
  }
  //dd($paramSearch);


  // Session::put('menahouseUserQuery', $paramSearch);

  $menahousefinder = new MenahouseSearchEngine ;
  $menahousefinder::SetQuerySearch($paramSearch);

  return redirect('search-results');


  // if (Auth::check()) {
  //   $userID = Auth::user()->id;
  //   if ($numberroom >= 4) {
  //     $houses = DB::table('obivlenie')->where('kolitchestvo_komnat', '>=', $numberroom)
  //                                     ->where('user_id', '!=', $userID)->get();
  //   } else {
  //     $houses = DB::table('obivlenie')->where('kolitchestvo_komnat', '=', $numberroom)
  //                                     ->where('user_id', '!=', $userID)->get();
  //   }
  // }else {
  //
  //   if ($numberroom >= 4) {
  //     $houses = DB::table('obivlenie')->where('kolitchestvo_komnat', '>=', $numberroom)->get();
  //   } else {
  //     $houses = DB::table('obivlenie')->where('kolitchestvo_komnat', '=', $numberroom)->get();
  //   }
  //
  // }
  //
  // $foundelemts = count($houses);
  //
  // return view('pages.properties_listing_lines', compact('houses', 'foundelemts', 'paramSearch'));
});


Route::get('property/type/{param}', function($param){

  $paramSearch = array('type_nedvizhimosti' => $param, 'typerequest' => '2');

  $menahousefinder = new MenahouseSearchEngine ;
  $menahousefinder::SetQuerySearch($paramSearch);

  return redirect('search-results');

});


 /// TODO : Mise a jour d un post
    /// sauvegarder les anciennes images liees au post ds un tableau oldImages
    /// uploader les nouvelles images et
    ///  en case de succes supprimer ttes les anciennes images ds oldImages

/// TODO : Url de recherche et url base api

    /// Url de recherche :nedvizhimosti/odnokomnatnye-kvartiry
    /// url base api : api/nedvizhimosti/odnokomnatnye-kvartiry
    /// result url : nedvizhimosti/odnokomnatnye-kvartiry/fruyfure87897567hg

    ///  en case de succes supprimer ttes les anciennes images ds oldImages

///====================>Travailler avec ces routes  ============================


// View::composer('layouts.partials.quick-search', function($view) {

//     return $view;
// });

/// Dingo api routes
$api = app('Dingo\Api\Routing\Router');

$api->version('v1',
    function($api) {
      $api->get('meanhouse/greeting', function(){
          return 'Wellcome to menahouse real estate app.';
    });

    $api->group(
         ['namespace' => 'App\Http\Controllers\Api\V1'],
         function ($api) {

           $api->get('search/house', 'ObivlenieController@index');
           $api->get('search/bytype', 'ObivlenieController@getHomeByType');

           
           $api->get('/user/appart', 'ObivlenieController@obyavlenieUtilisateur');
           $api->get('support/user/appart', 'ObivlenieController@obyavlenieUtilisateurBySupport');


           $api->get('/user/favoris', 'ObivlenieController@favoris');
           $api->get('/add/favoris', 'ObivlenieController@ajoutFavoris');

           $api->get('/cities', 'CitiesController@index');
           $api->get('/city/districts', 'CitiesController@getDistrictByCity');

           // endpoint pour toutes nos recherches
           $api->get('recherches', 'ObivlenieController@recherchesAppartements');

           $api->get('appart', 'ObivlenieController@informationAppart');           
    });
});


    Route::get('home/search/{qredirecturl}/{qfield}/{qvalue}',
                                            'ObivlenieController@getHomeByType');

    Route::get('welcome-home', function(League\Glide\Server $server){

        dd(Auth::user());

        $arr = ['type_nedvizhimosti' => 'Квартира', 'gorod' => 'Москва'];
      ///  $q = Obivlenie::where($arr)->paginate(2);

                $q = Obivlenie::where('gorod', 'Москва')->get();
                        $users =  User::all();

      //  dd($users);

      //  dd(Cache::get('tworooms-key-isAuth'));
        return view('welcome');
    });


    Route::post('menahouse/recherches', 'ObivlenieController@recherchesApparts');


// });

/// url servant les differentes requetes de recherches des users ===============

Route::get('s/{url}', 'ObivlenieController@trouverAppart');
Route::get('{url}/r', 'ObivlenieController@resultatsRecherches');

Route::post('extractquery', 'ObivlenieController@extractUserRequestData');
Route::get('getqueryresults', 'ObivlenieController@getItemsCollections');

Route::get('search-results', function(){
    return view('pages.properties_listing');
});


///=============================================================================


Route::post('property/catalogue', 'ObivlenieController@searchEngine');
Route::post('properties/all', 'ObivlenieController@getCatalogue');
Route::get('properties/all', 'ObivlenieController@getAllProperties');


// Route::post('getSearchqueryValues', function(){
//
//   $value = Session::get('menahouseUserQuery');
//   return  redirect('search-results');
//
// });


// ==== angular search filters

Route::post('setfilter', 'SessionController@setfilterValue');
Route::get('getfilter', 'SessionController@getfilterValue');

// ==== end


// Route::post('house/catalogue', 'ObivlenieController@search');
// Route::get('dashboard',  'DashboardController@show');

/*
* register
*/
Route::get('pricing', function(){

if (array_key_exists('range', Session::get('menahouseUserQuery'))){
    dd(Session::get('menahouseUserQuery'));
}


  return view('registration.plan');
});

Route::post('/sorted/properties', 'ObivlenieController@sortResult');

Route::post('signup', function(){
  // $plan = Input::get('plan');
  return view('registration.create');
});

Route::get('register', ['as' => 'register_path',
                        'uses' => 'RegistrationController@create']);
Route::post('register', ['as' => 'register_path',
                         'uses' => 'RegistrationController@store']);


Route::get('register/verify/{confirmationCode}', [ 'as' => 'confirmation_path',
            'uses' => 'RegistrationController@confirm'
]);


Route::get('confirmation', function(){
    //  return View('registration.confirm_account');
    $email = 'husseincoulibaly@gmail.com';
    return view('registration.confirm_account', compact('email'));
});

/*
* Session
*/
Route::get('login', ['as' => 'login_path',
                     'uses' => 'SessionController@create']);
Route::post('login', ['as' => 'login_path',
                     'uses' => 'SessionController@store']);


Route::get('logout', [ 'as' => 'logout_path',
   'uses' => 'SessionController@destroy'
  ]);

Route::get('sign-in', ['as' => 'login_path',
                       'uses' => 'Auth\AuthController@getLogin']);
Route::post('sign-in', ['as' => 'login_path',
                        'uses' => 'Auth\AuthController@postLogin']);

Route::get('sign-up',  function(){

     return View('registration.create');
});

Route::get('auth/register',  function(){

     return View('registration.create');
});


Route::post('sign-up', ['as'=>'register_path',
                         'uses' => 'RegistrationController@store']);

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('logout', ['as' => 'auth_logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register', ['as' => 'auth_register',
                            'uses' => 'Auth\AuthController@getRegister']);

// Route::post('auth/register', ['as'=>'auth_register',
//                               'uses' => 'Auth\AuthController@postRegister']);

Route::get('terms-conditions', function()
{


    // $data = ['confirm_cod' => '123'];
    // Mail::send('mails.news', $data, function($m){
    //     $m->to('company.menahouse@gmail.com');
    //     $m->subject('test mail');
    // });

    // dd(Cache::get('sidebar-filtre'));
    return View('pages.terms_conditions');
});


// Route::get('/home', function () {
// //  dd(categorie()->id->where::('name', $categorie));
//   $roleCount = Role::count() ;
//   if ( $roleCount != 3){
//       $roleadm = Role::wherename('Admin')->first();
//       // $rolemembr = Role::where('name', 'Member')->value('id');
//       if( ! $roleadm ){
//           Role::create(['name' => 'Admin']);
//       }
//
//       $rolemod = Role::wherename('Moderator')->first();
//       // $rolemembr = Role::where('name', 'Member')->value('id');
//       if( ! $rolemod ){
//           Role::create(['name' => 'Moderator']);
//       }
//
//       $rolemembr = Role::wherename('Member')->first();
//       // $rolemembr = Role::where('name', 'Member')->value('id');
//       if( ! $rolemembr ){
//           Role::create(['name' => 'Member']);
//       }
//   }
//
//   return view('welcome');
// });


Route::get('/', 'ObivlenieController@index');

//
// Route::get('/dfsg', function () {
// });


Route::any( '{catchall}', function ($page) {
    return view('pages.404');
})->where('catchall', '(.*)');
