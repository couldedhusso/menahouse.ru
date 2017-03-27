<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Menahouse\Contracts\AdvertiseInterface;
use DB;
use App\Bookmarked;
use App\Obivlenie;

class FavorisUtilisateurController extends Controller
{

    protected $repos ;
    protected $dispatcher ;

    public function __construct(AdvertiseInterface $repos){
        $this->repos = $repos;
        $this->dispatcher = app('Dingo\Api\Dispatcher');
    }


    public function bookmarkItem($id){

        /// TODO :   RENAME obivlenie_id TO  item_id
       $url = 'api/add/favoris?id='.$id;
       $reponse = $this->dispatcher->raw()->get($url);
       return Redirect()->back();
    }

    public function removeItem(Request $data){

    }

    public function getBookmarkItemUser(){


        //   $url = '/api/user/favoris';

        //   $reponse = 

          $id = $this->repos->userId();


          $ids = Bookmarked::where('user_id', $id)
                                   ->pluck('obivlenie_id')
                                   ->toArray();

          $favoris = Obivlenie::whereIn('id', $ids)
                                ->unblocked()
                                ->paginate(10);

        dd($favoris);

        // $flag = 'bookmarked';
        // $show_link = true;

        // $favoris = Bookmarked::where('bookmarked.user_id', $id)
        //                                  ->join('obivlenie', 'bookmarked.obivlenie_id', '=', 'obivlenie.id')
        //                                  ->join('thumb', 'thumb.obivlenie_id', '=', 'obivlenie.id')
        //                                  ->select('obivlenie.price', 
        //                                          'obivlenie.metro', 
        //                                          'obivlenie.kolitchestvo_komnat', 
        //                                          'obivlenie.type_nedvizhimosti', 
        //                                          'obivlenie.ulitsa', 
        //                                          'bookmarked.id as bkm_id', 
        //                                          'bookmarked.created_at as bkm_date',
        //                                          'thumb.file_name'
        //                                 )
        //                                 ->paginate(10);
        

        return view('sessions.bookmarked', compact('favoris', 'flag', 'show_link'));
    }

    private  function getbookmarked($id, $userID, $bookmarkable)
    {


      $bkm =  Bookmarked::whereuser_id($userID)
                          ->wherebookmarkable_id($id)
                          >AndWhere('deleted', '=', false )
                          ->first();

      if ($bkm == null ) {

          $date = date_create(Carbon::now());
          $bkm_date = date_format($date,"d.m.Y");

          $img = new Images ;
          $img = $obivlenie->images()->create(array('path' => $filename));

          $imgvalue->move($StoragePath["storage"] , $filename);

         //  $imgvalue->move(public_path().'/storage/pictures' , $filename);
          $obivlenie->images()->save($img);

          $favoris = Bookmarked::create([
            'user_id' => $userID,
            'obivlenie_id' => $id,
          ]);
      } else {
          $bkm->deleted = true;
          $bkm->save();
      }

    }
}
