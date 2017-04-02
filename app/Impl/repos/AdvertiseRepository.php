<?php namespace Menahouse\Repositories;



///
/// TODO : Menahouse
/// Toastr push msge with non read msges == Мы рады вас видеть снова
/// у вас есть хх сообщения
/// https://accounts.google.com/signin/v1/lookup
///

///
/// TODO : Menahouse
/// avoir un endpoint pour les recherches vers lequel
/// Angular et les autres frameworks js pourront pointer (
/// parametres : url de redirection et donnees de recherches )
///

use Uuid;
use Auth;
use DB;
use Cache;
use Session;

use Illuminate\Http\Request;
use App\Images ;
use App\Categorie ;
use App\Obivlenie ;
use App\User;
use App\District;
use App\City;
use App\Thumbnail;
use App\Bookmarked;
use Menahouse\CustomHelper;


use Carbon\Carbon;
use Illuminate\Support\Collection;

use App\Events\ObivlyavleniyeWasStored;
use Illuminate\Support\Facades\Event;

use Illuminate\Support\Str;
use Menahouse\Contracts\AdvertiseInterface;
use Menahouse\Contracts\ImageManipulationInterface;

use Menahouse\MenahouseSearchEngine;


class AdvertiseRepository implements AdvertiseInterface
{


  ///// ===== Private class methods


  protected $imageRepos;
  protected $dispatcher;
  public function __construct(ImageManipulationInterface $clsImageHelper){

      $this->imageRepos = $clsImageHelper;
      $this->dispatcher = app('Dingo\Api\Dispatcher');

  }

  public function userId () {
     return Auth::id();
  }

  private function isAuthentificated () {
        return Auth::check();
  }


  private function generateCacheKeys($url, $page = 1){
     if($this->isAuthentificated()){
        return $url.'_isAuth_'.$page;
     }
      return $url.'_guest_'.$page;
 }


 public function appartDetails($id){
      
      $minutes =  $this->setCacheTime();
      $cacheKey = 'appart_guest_'.$id;

      if($this->isAuthentificated()){
          $cacheKey = 'appart_auth_'.$id;
      }

      return Cache::remember($cacheKey, $minutes , function() use($id){
            return  Obivlenie::where('id', $id)->first();
      });
 }

  public function userBookmarks($request){

        $user_id = $this->userId();

        $dansFavoris = Bookmarked::find($favoris['id']);

        if (null !== $dansFavoris){
          return true;
        }

        $favoris = Bookmarked::create([
            'user_id' => $user_id,
            'obivlenie_id' => $favoris['id']
        ]);
        return $favoris;
 }



 // ======  TODO : remplacer ttes les appart details par cette function 
//  public function infoAppart($id, $withImages = null){

//         $url = 'api/user/appart?include=images';        
       
//         $response = $this->dispatcher->raw()->get($url);  
//         $house = json_decode($response->content());

//         return  $house->data;
//  }


 private function getCountHouseByType($parametres, $cacheKey) {

    //   $arr_obj = new ArrayObject($parametres['criteria']);
    //   $iterator = $arr_obj->getIterator();
    //   $url_key = $iterator->key;

    //   $cacheKey = $this->generateCacheKeys($url);
        $minutes =  $this->setCacheTime();

        // //// TODO : A refactoriser
        $qb = "SELECT COUNT(*) As nbrhouse FROM obivlenie WHERE ";
        $params = [];
        $setparam = 0;
        foreach ($parametres as $key => $value) {
             $qb = $qb.$key." = :".$key;
            // if (('kolitchestvo_komnat' == $key ) && ( 4 == $value) ){
            //         $qb = $qb.$key." >= :".$key;
            // }else{
            //     $qb = $qb.$key." = :".$key;
            // }
            $params += [ $key => $value];
        }

        $qb = $qb. " AND available = 1" ;

        /// TODO : il faut flusher le cache lorsque l user se connecte

        if ($this->isAuthentificated()){

            $cacheKey = $cacheKey."-isAuth";
            $qb = $qb. " AND user_id <> ".$this->userId();
        }

        $houses = Cache::remember($cacheKey, $this->setCacheTime(),
                                                    function() use($qb, $params) {
            return DB::select(DB::raw($qb), $params);
        });

        return $houses[0]->nbrhouse;
    }


 ///// ================== Public class methods

  public function setCacheTime(){
      if ($this->isAuthentificated()){
          return  Carbon::now()->addMinutes(1);
      }
      return Carbon::now()->addMinutes(10);
  }

  public function getCountHouse(){

     $houses = collect([]);

     $parametres = [
        'oneroom' => ['kolitchestvo_komnat' => 1],
        'tworooms' => ['kolitchestvo_komnat' => 2],
        'threerooms' => ['kolitchestvo_komnat' => 3],
        'fourplusrooms' => ['kolitchestvo_komnat' => 4],
        'home' => ['type_nedvizhimosti' => '3'],
        'newhome' => ['type_nedvizhimosti' => '4'],
     ];


     /// TODO : ajouter nedvizhimosti a ttes les urls

     $url = [
        'oneroom'       => 'odnokomnatnye-kvartiry',
        'tworooms'      => 'dvuhkomnatnye-kvartiry',
        'threerooms'    => 'trehkomnatnye-kvartiry',
        'fourplusrooms' => 'chetyrehkomnatnye-kvartiry',
        'home'          => 'chastnye-doma',
        'newhome'       => 'novostrojki',
     ];

     $cacheKeys = [
        'oneroom'       => 'oneroom-key',
        'tworooms'      => 'tworooms-key',
        'threerooms'    => 'threerooms-key',
        'fourplusrooms' => 'fourplusrooms-key',
        'home'          => 'chastnye-doma-key',
        'newhome'       => 'novostrojki-key',
     ];

      foreach ($parametres as $key => $params) {

        $res = [$url[$key], $this->getCountHouseByType($params, $cacheKeys[$key])];
        $houses->push($res);
      }

      return $houses;
  }

  public function RecherchesApparts($request) {

      if (isset($request['_index_r'])){

         $paramSearch =  $this->indexRecherche($request);
               
      } else{
         $paramSearch =  $this->filtre($request);
      }


    Session::put('menahouseUserQuery', $paramSearch);

    return $paramSearch['url'].'/r';
  }


 private function filtre ($request) {

    $term = []; $params = [];

     $url = '';
     $rgx = "#[a-z]$#"; // notre url se termine par une chaine de charactere

     $type_nedvizhimosti =  [
            '1' => 'kvartira',
            '2' => 'komnaty',
            '3' => 'chastnye-doma',
            '4' => 'novostrojki',
     ];

     $gorod = [
          '0' => 'vce-goroda',
          '2' => 'moskva',
          '3' => 'moskovskaya-oblast',
          '4' => 'novaya-Moskva',
     ];

     $status = [
          '1' => 'obmen',
          '2' => 'obmen-prodazha',
     ];

     $mapUrl = [
         'gorod' =>   $gorod,
         'type_nedvizhimosti' =>  $type_nedvizhimosti,
         'status' => $status
     ];

    $setRange = [
            $request['rangeMin'],
            $request['rangeMax']
    ];


    // ===== IMPORTANT - TODO: A refactoriser

     
     foreach ($request as $key => $value) {

          if ('gorod' == $key ){

              if ($value == 1) $value = "";
         }

         if (in_array($request['gorod'] , [3, 4])){

                if ('rayon' == $key  && !in_array($value, [12])){
                    $value = "";
                }
              
         }
        
         if (!empty($value) && ('_token' != $key)
                            && (!in_array($key, ['rangeMax', 'rangeMin'])))  {

            //construction de l'url de redirection
            if (array_key_exists($key, $mapUrl) ){
                 if (preg_match($rgx, $url)) {
                    $url = $url.'-'.$mapUrl[$key][$value];
                 } else {
                    $url = $mapUrl[$key][$value];
                 }

            }  // fin condition url


            //// ====== à revoir

            /// ====== ATTENTIO BUG !!!! ================
            /// quick-search.blade
            //// bug detecter au niveau des districts - Все районы
            /// lorsque l user choisit Все районы
            /// il est affecte une valeur (soit 1 ou 6 ) en fonction de la ville

            if ('gorod' == $key ){
                $value = $value - 1 ;
            }

            if ('tseli_obmena' == $key) {
                $value =  ($value == 1) ? 2 : 1;
            }

            $params += [$key => $value ];

         }
     } // fin foreach


     $paramSearch =['url' => $url, 'criteria' => $params, 'range' => $setRange];

     return $paramSearch;

 } 

 private function indexRecherche($request) {

    $term = []; $params = [];

     $url = '';
     $rgx = "#[a-z]$#"; // notre url se termine par une chaine de charactere

     $type_nedvizhimosti =  [
            '1' => 'kvartira',
            '2' => 'komnaty',
            '3' => 'chastnye-doma',
            '4' => 'novostrojki',
     ];

     $gorod = [
          '1' => 'moskva',
          '2' => 'moskovskaya-oblast',
          '3' => 'novaya-Moskva',
     ];

     $mapUrl = [
         'gorod' =>   $gorod,
         'type_nedvizhimosti' =>  $type_nedvizhimosti,
     ];


    // ===== IMPORTANT - TODO: A refactoriser

     
     foreach ($request as $key => $value) {
        
         if (!empty($value) && (!in_array($key, ['_token', '_index_r'])))   {

            //construction de l'url de redirection
            if (array_key_exists($key, $mapUrl) ){
                 if (preg_match($rgx, $url)) {
                    $url = $url.'-'.$mapUrl[$key][$value];
                 } else {
                    $url = $mapUrl[$key][$value];
                 }

            }  // fin condition url

            $params += [$key => $value ];

         } // fin if
     } // fin foreach

     // aucuns critere de recherches, dans ce cas prendre le critere par defaut

     if (0 == count($params)){
         $params = ['gorod' => 1 ];
         $url = $gorod[1];

     }

    //   if (!array_key_exists('gorod', $params) ){
                
    //     $url = 'vse-goroda'.'-'.$url;
               
    //   }  // fin condition url

     return ['url' => $url, 'criteria' => $params];

 } 

 public function getApparts($url){


    // $type_nedvizhimosti =  [
    //         '1' => 'kvartira',
    //         '2' => 'komnaty',
    //         '3' => 'chastnye-doma',
    //         '4' => 'novostrojki',
    //  ];

    $mapUrl = [
        'odnokomnatnye-kvartiry'     => ['kolitchestvo_komnat' => '1'],
        'dvuhkomnatnye-kvartiry'     => ['kolitchestvo_komnat' => '2'],
        'trehkomnatnye-kvartiry'     => ['kolitchestvo_komnat' => '3'],
        'chetyrehkomnatnye-kvartiry' => ['kolitchestvo_komnat' => '4'],
        'chastnye-doma'  =>   ['type_nedvizhimosti' => '3'],
        'novostrojki'    =>   ['type_nedvizhimosti' => '4'],
     ];

     $paramSearch =['url' => $url, 'criteria' => $mapUrl[$url]];

    // dd($paramSearch);

     Session::put('menahouseUserQuery', $paramSearch);

     return $url.'/r';
 }


 public function ajouterAuxFavoris($request){

     $obivlenie_id = $request->query('id');

     $criteria = [
         'obivlenie_id' => $obivlenie_id, 
         'user_id' => Auth::id(), 
         'deleted' => '0' 
     ];

     $ids = Bookmarked::where($criteria)->first();

    // l user n a pas de favoris pour cet element en particulier
    if (null == $ids){
        $fv =  Bookmarked::create($criteria);
        return true ;
    }

    // l element exist ds la bd 
    return false ;
 }

 public function obyavlenie(){
     return Obivlenie::where('user_id', $this->userId())->first();
 }

 public function userObyavlenie($request){

     $userId =  $request->query('userId');
     return Obivlenie::where('user_id', $userId)->first();
 }


 public function favorisUtilisateur($page){

        $id =  $this->userId();
        $url = 'favoris_user_'.$id;

        $ids = Bookmarked::where('user_id', $id)
                                   ->pluck('obivlenie_id')
                                   ->toArray();

        $cacheKey = $this->generateCacheKeys($url);
        $minutes =  $this->setCacheTime();

        return Cache::remember($cacheKey, $minutes , function() use($ids){


                    return Obivlenie::whereIn('id', $ids)
                                ->unblocked()
                                ->paginate(10);
        });

 }



 public function resultatRecherches($page){



      $range_key = 'range';

      $params = Session::get('menahouseUserQuery');

      if (null === $params) {
         return false;
      }

     // dd($params);

    //  return Obivlenie::where($params['criteria'])
    //                            ->unblocked()
    //                            ->paginate(10);

      $cacheKey = $this->generateCacheKeys($params['url'], $page);
      $minutes =  $this->setCacheTime();

      if($this->isAuthentificated()){

            // $cacheKey = $this->generateCacheKeys($params['url'], $page);
            $userId = $this->userId();

            return Cache::remember($cacheKey , $minutes, function()
                use($params,  $userId, $range_key ) {

                        if (array_key_exists($range_key , $params)){

                             return Obivlenie::where($params['criteria'])
                                    ->unblocked()
                                    ->whereBetween('obshaya_ploshad', $params['range'])
                                    ->where('user_id', '<>', $userId)
                                    ->paginate(15);
                        }

                        return Obivlenie::where($params['criteria'])
                                ->unblocked()
                                ->where('user_id', '<>', $userId)
                                ->paginate(15);
            });

      } // fin user auth

    //   $search_array['first']
    //   array_key_exists($range_key, $params)
      if (array_key_exists($range_key, $params)){


            $houses = Cache::remember($cacheKey, $minutes , function() use($params){
                    return Obivlenie::where($params['criteria'])
                                        ->unblocked()
                                        ->whereBetween('obshaya_ploshad', $params['range'])
                                        ->paginate(15);
                });
      }

     // return Obivlenie::unblocked()->paginate(10);

    // dd($result);


     // dd($params);


      return Cache::remember($cacheKey, $minutes , function() use($params){

                  return  Obivlenie::where($params['criteria'])
                               ->unblocked()
                            //    ->paginate(4);
                               ->paginate(15);

      });


 }

 public function housesByType($page)  {

      $params = Session::get('menahouseUserQuery');

      $cacheKey = $this->generateCacheKeys($params['url'], $page);
      $minutes =  $this->setCacheTime();

      if($this->isAuthentificated()){

            // $cacheKey = $this->generateCacheKeys($params['url'], $page);
            $userId = $this->userId();

            return Cache::remember($cacheKey , $minutes, function()
                use($params,  $userId) {

                        return Obivlenie::where($params['criteria'])
                                ->unblocked()
                                ->where('user_id', '<>', $userId)
                                ->paginate(15);
            });
      }

     return Cache::remember($cacheKey, $minutes , function() use($params){
         return Obivlenie::where($params['criteria'])
                    ->unblocked()
                    ->paginate(15);
         });
 }



 public function storeAppartement($request){

        $user_id = $this->userId();

        $obivlenie = obivlenie::create([
            'uuid' => Uuid::generate(4)->string,
            'metro' => $request['submit-metro'],
            'gorod' =>  $request['gorod'] ,
            'ulitsa' =>  $request['submit-address'],
            'type_nedvizhimosti' => $request['type_nedvizhimosti'],
            'tekct_obivlenia' => $request['submit-description'],
            'kolitchestvo_komnat' => $request['kolitchestvo_komnat'],
            'etajnost_doma' => $request['submit-etajnost_doma'] ,
            'zhilaya_ploshad' => $request['zhilaya_ploshad'] ,
            'obshaya_ploshad' => $request['obshaya_ploshad'] ,
            'ploshad_kurhni' => $request['ploshad_kurhni'] ,
            'rayon' => isset($request['rayon']) ? $request['rayon'] : $this->getDistrict($request['gorod']) , /// trouver une autre parade
            'roof' => $request['roof-size'],
            'etazh' => $request['submit-etazh'],
            'san_usel' => $request['submit-Baths'],
            // 'title' => $request['title'],
            'price' => $request['predpolozhitelnaya_tsena'] ,
            'status' => $request['submit-status'],
            'tseli_obmena' => $request['submit-tseli-obmena'],
            'mestopolozhenie_obmena' => $request['mestopolozhenie_obmena'],
            'doplata' => $request['doplata'],
            'numberclick' => 0,
          //  'predpolozhitelnaya_tsena' => Input::get('predpolozhitelnaya_tsena'),
            'user_id' => $user_id,
        ]);


        // $thumbnailName = $obivlenie->id ;

        // TODO : implementer un classe qui se chargera de l upload des
        //  images
        $madeThumnail = false ;

        

       /// dd($request['file-upload']);


   //  =============== TODO : A refactoriser


    if (null !== $request['file-upload'][0]){

        foreach($request['file-upload'] as $imgvalue) {

               if( $imgvalue->isValid() ){

                   // $filename = sha1(time().'.'.$imgvalue->guessClientExtension());

                   $name = sha1(time().'.'.$imgvalue->getClientOriginalName());

                   $filename = $name.'.'.$imgvalue->guessClientExtension();


                    if (! $madeThumnail){

                       $thumbnailFileName = 'tn-'.$filename;

                       $ThumbNail = ThumbNail::create([
                         'obivlenie_id' => $obivlenie->id,
                         'file_name' => $thumbnailFileName
                       ]);

                       $thumbImag = new Images;
                       $thumbImag = $ThumbNail->images()->create(array('path' => $thumbnailFileName));

                       $this->imageRepos->UploadToS3($thumbnailFileName, file_get_contents($imgvalue));
                       $ThumbNail->images()->save($thumbImag);

                       $madeThumnail = true ;
                   }

                   $img = new Images ;
                   $img = $obivlenie->images()->create(array('path' => $filename));
                   $this->imageRepos->UploadToS3($filename, file_get_contents($imgvalue));

                   $obivlenie->images()->save($img);
               }
          }


    }


        //     $madeThumnail = true ;
        //     $imgPath = ' ';
        //     foreach(Input::file('pics') as $imgvalue) {

        //        $filename = str_random(4)."-".$imgvalue->getClientOriginalName();
        //        $filePath = 'dev/images/pics/' .$filename;

        //        if( $imgvalue->isValid() ){
        //             if (! $madeThumnail){
        //                 $filePath = 'dev/thumbs/' .$thumbnailName;
        //                 $CloudStorage->put($filePath, file_get_contents($thumbnail), 'public');
        //                 $madeThumnail = true ;
        //             }

        //             //  $imgProperty = Image::make(file_get_contents($imgvalue))->resize(848, 430) ;
        //             $imgPath = $imgPath.' '.$filename ;
        //             // $imgvalue->move($storage_path, $filename);
        //             $CloudStorage->put($filePath, file_get_contents($imgvalue), 'public');

        //             $imgParam = [
        //                 'index' => 'menahouse',
        //                 'type'  => 'images',
        //                 'body' => [
        //                     'imageable_id ' => $obivlenie->id,
        //                     'path' => $filename,
        //                   ]
        //             ];

        //             $img = new Images ;
        //             $img = $obivlenie->images()->create(array('path' => $filename));
        //             $obivlenie->images()->save($img);

        //             // indexer les images de la publication dans elasticsearch
        //             $indexmodel->ModelMapping($imgParam);
        //        }
        //   }


          if ($obivlenie) {
              $user = User::whereid($obivlenie->user_id)->select('id', 'email')->first();
              Event::fire( new ObivlyavleniyeWasStored($user));
          }

        //  $del = obivlenie::find($obivlenie->id)->delete();

         // return $del;

          return 'me/obyavlenie' ;
 }


    public function updateAppart($request){



         

    if (null !== $request['file-upload'][0]){

        foreach($request['file-upload'] as $imgvalue) {

               if( $imgvalue->isValid() ){

                   // $filename = sha1(time().'.'.$imgvalue->guessClientExtension());

                   $name = sha1(time().'.'.$imgvalue->getClientOriginalName());

                   $filename = $name.'.'.$imgvalue->guessClientExtension();


                    if (! $madeThumnail){

                       $thumbnailFileName = 'tn-'.$filename;

                       $ThumbNail = ThumbNail::create([
                         'obivlenie_id' => $obivlenie->id,
                         'file_name' => $thumbnailFileName
                       ]);

                       $thumbImag = new Images;
                       $thumbImag = $ThumbNail->images()->create(array('path' => $thumbnailFileName));

                       $this->imageRepos->UploadToS3($thumbnailFileName, file_get_contents($imgvalue));
                       $ThumbNail->images()->save($thumbImag);

                       $madeThumnail = true ;
                   }

                   $img = new Images ;
                   $img = $obivlenie->images()->create(array('path' => $filename));
                   $this->imageRepos->UploadToS3($filename, file_get_contents($imgvalue));

                   $obivlenie->images()->save($img);
               }
          }


    }



         return 'me/obyavlenie' ;

    }

//  public function saveAs($model, $fileName, Uploadfile $file){

//  }

 public function getDistrict($city_id){
    $distict =  DB::table('districts')->where('city_id', $city_id)
                    ->select('id')
                    ->first();

    return $distict->id;
 }


//  public function imageUpload(Oblivenie $advert,  $imges){

//      return "";

//  }




///// ====== Gestion  des favoris utilisateurs


    public function getbookmarks(){

        $id =  $this->userId();
        $url = $id.'favoris';

        $cacheKey = $this->generateCacheKeys($url);
        $minutes =  $this->setCacheTime();

        return Cache::remember($cacheKey, $minutes , function() use($id){


                    return Bookmarked::where('bookmarked.user_id', $id)
                                        ->join('obivlenie', 'bookmarked.obivlenie_id', '=', 'obivlenie.id')
                                        ->select('obivlenie.price',
                                                 'obivlenie.metro',
                                                 'obivlenie.kolitchestvo_komnat',
                                                 'obivlenie.type_nedvizhimosti',
                                                 'obivlenie.ulitsa',
                                                 'bookmarked.id as bkm_id',
                                                 'bookmarked.created_at as bkm_date'
                                        )
                                        ->paginate(10);
        });
    }

    // private  function getbookmarkUser($id, $userID, $bookmarkable)
    // {


    //   $bkm =  Bookmarked::whereuser_id($userID)
    //                       ->wherebookmarkable_id($id)
    //                       >AndWhere('deleted', '=', false )
    //                       ->first();

    //   if ($bkm == null ) {

    //       $date = date_create(Carbon::now());
    //       $bkm_date = date_format($date,"d.m.Y");

    //       $img = new Images ;
    //       $img = $obivlenie->images()->create(array('path' => $filename));

    //       $imgvalue->move($StoragePath["storage"] , $filename);

    //      //  $imgvalue->move(public_path().'/storage/pictures' , $filename);
    //       $obivlenie->images()->save($img);

    //       $favoris = Bookmarked::create([
    //         'user_id' => $userID,
    //         'obivlenie_id' => $id,
    //       ]);
    //   } else {
    //       $bkm->deleted = true;
    //       $bkm->save();
    //   }

    // }

}
