<?php namespace App\Http\Controllers;

// require base_path('vendor/autoload.php');


use Uuid;

// use App\Http\Requests;
use App\Images ;
use App\Categorie ;
use App\Obivlenie ;
use App\User;
use App\Thumbnail;
use App\Bookmarked;
use Menahouse\CustomHelper;
// use Request;
use Session;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Session\Store;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View;

use Elasticsearch;
use Elasticsearch\Client;
use Illuminate\Support\Str;

use Auth ;
use DB;

use Menahouse\MenahouseSearchEngine;
use Menahouse\Contracts\AdvertiseInterface;


use Redirect;

use App\Events\ObivlyavleniyeWasStored;
use Illuminate\Support\Facades\Event;

use Dingo\Api\Http;
use Dingo\Api\Routing\Helpers;
use Dingo\Api\Http\Response\Format;

use App\Http\Response\FractalResponse;
use App\Http\Transformers\HomeTransformer;

use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Manager;

// use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;
use Menahouse\Contracts\ImageManipulationInterface;
use JavaScript;


use Storage;
use Cache;

use Menahouse\Repositories\PolicyRepository;
use Validator;

class ObivlenieController extends Controller
{


    use Helpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $searchresults ;
    protected $repos ;
    protected $policies ;
    protected $dispatcher ;
    protected $rechercheResulstUrl;

    protected $imageRepos;
  
    // protected $fractal;


    public function __construct(AdvertiseInterface $repos, PolicyRepository $policies, 
                                                           ImageManipulationInterface $clsImageHelper)
    {
        $this->repos = $repos;
        $this->policies = $policies;
        $this->dispatcher = app('Dingo\Api\Dispatcher');
        $this->rechercheResulstUrl = 'api/recherches';
        $this->imageRepos = $clsImageHelper;
        // $this->fractal = $fractal;
    }


    public function index()
    {

        $houses = $this->repos->getCountHouse();
        return view('welcome', compact('houses'));
    }

    public function new(Request $request)
    {

        if($this->policies->isOwner($request->user())){
            return redirect('me/obyavlenie');
        }

        return View('sessions.additem') ;

        // return view('welcome', compact('oneroom', 'tworooms', 'threerooms',
        //                          'fourplusrooms', 'home', 'newhome'));
    }

    public function getUserObyavlenieBySupport($id){

        $endPoint = 'support/user/appart?userId='.$id;

        if (Auth::user()->hasRole('Admin') || 
                Auth::user()->hasRole('Moderator')){

                    $response = $this->api->raw()->get($endPoint);
                    $house = json_decode($response->content());

                    if (null !== $house) $house = $house->data;
                
                    $flag = 'advertisements';
                    $show_link = true;

                    return View('sessions.dashboard', compact('flag', 'house', 'show_link'));

        }

        return redirect('/');
    }



    public function getUserObyavlenie()
    {

        $response = $this->api->raw()->get('/user/appart');

        $house = json_decode($response->content());

        if (null !== $house) $house = $house->data;
    
        $flag = 'advertisements';
        $show_link = true;

        return View('sessions.dashboard', compact('flag', 'house', 'show_link'));
    }


    public function getUserFavoris()
    {

        $response = $this->api->raw()->get('/user/favoris');
        $house = json_decode($response->content());

        $r = json_decode($response->content());

        $favoris = $r->data;
        $favorismeta = $r->meta->pagination;

        JavaScript::put([
            'favoris' => $r->data,
            'favorismeta' => $r->meta->pagination
        ]);

        //dd($favorismeta );

        // $house = $house->data;

        //  JavaScript::put([
        //     'data' => $r->$house,
        //     'meta' => $r->meta->pagination
        // ]);


        // dd($house);

        $flag = 'advertisements';
        $show_link = true;

        return View('sessions.bookmarked', compact('flag', 'show_link', 'favoris', 'favorismeta'));
    }

    public function recherchesApparts(Request $request)
    {

        //dd($request::all());

        $redirect_url = $this->repos->RecherchesApparts($request->all());
        return redirect($redirect_url);
    }


    public function trouverAppart($url)
    {

        
        $redirect_url = $this->repos->getApparts($url);

        return redirect($redirect_url);
    }

    public function resultatsRecherches($url)
    {


        // TODO : creation un systeme de notification
        ///   Notifications()->succes();

        $response = $this->api->raw()->get($this->rechercheResulstUrl);

        if (null == $response->original) return redirect('/');

        $r = json_decode($response->content());
        $data = $r->data;
        $meta = $r->meta->pagination;

        $paginator = $response->original;

        return view('pages.results', compact('data', 'meta', 'paginator'));
    }

    public function detailsAppart($name, $id)
    {
        

        $url = 'api/appart?id='.$id.'&include=images';

        $response = $this->api->raw()->get($url);

        $house = json_decode($response->content());

        if(null == $house) return redirect('/');

        $house = $house->data;

        return View('house.property_details', compact('house'));
    }

    public function editAppart(Request $request){

        $id  = $request->user()->id ;  
        $url = 'api/user/appart?include=images';        
       
        $response = $this->dispatcher->raw()->get($url);  
        $house = json_decode($response->content());
        $house = $house->data;

        

        // dd($house);

        return View('sessions.update-item', compact('house', 'id')) ;
    }


    



    /// TODO : modifier cette partie  à l aide d un middelware
    /// un seul point d entree pour ttes les requetes de recherche
    /// Afficher la page 404 pour une annonce bloquee

    public function getHomeByType($url, $qfield, $qvalue)
    {

        // $menahousefinder = new MenahouseSearchEngine ;
        $paramSearch =['url' => $url, 'ncriteria' => $qfield, 'vcriteria' => $qvalue];
        Session::put('menahouseUserQuery', $queryParameters);
        $menahousefinder::SetQuerySearch($paramSearch);

        $redirect_url = $url.'/r';

        // TODO : return view
        return redirect($r_url);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
          la class contient differentes fucntion
          par exemple la creation de repertoires getStorageDirectory
          la geolocation : getResponseRequest

        */

        /// ===== TODO : 

        // 1 - verifier qu il a charge des photos
        // 2 - validation des images
        // 3 - charger persister la bd

        // $validator = Validator::make($request->all(), [
        //     'title' => 'required|unique:posts|max:255',
        //     'body' => 'required',
        // ]);

        

        // $validator = Validator::make($request, [
        //     'file-upload' => 'mimes:jpg,jpeg,png,bmp'
        // ]);

        // dd($validator->fails());

        // if ($validator->fails()) {
        //     return redirect()->back()
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }

        // dd('df');


        //// en cours de modif

       //s dd($request->all());

          $redirect_url = $this->repos->storeAppartement($request->all());

          // tout est ok nous retourner une a la page des publications
          return Redirect('me/obyavlenie');
    }

    public function resultsSearch()
    {
        if (count($this->searchresults) == 0) {
            $menahousefinder = new MenahouseSearchEngine ;
            $term["gorod"] = "Москва";
            $this->searchresults = $menahousefinder->getIndexedElements($term);
        }
        return json_encode($this->searchresults);
    }

    public function sortResult()
    {

        $paramSearch = Input::except('_token');
        $foundNotEmptyValue = false;

        $setOrderBy = [
              '1' => 'price',
              '2' => 'obshaya_ploshad',
              '3' => 'created_at'
        ];

        $setRange = [
               '1' => 'BETWEEN 30 AND 70',
               '2' => 'BETWEEN 70 AND 90',
               '3' => 'BETWEEN 90 AND 110',
               '4' => '> 110'
        ];

        $sort = $paramSearch['sorting'];

        foreach ($paramSearch as $key => $value) {
            if (!empty($value) and $key !== 'sorting') {
                if ($key  !== 'obshaya_ploshad') {
                    $strParam = $key;
                    $foundNotEmptyValue = true;
                    break;
                } else {
                    $qb = "SELECT * FROM obivlenie WHERE $key $setrange[$value]";
                    $qb = $qb." ORDER BY ".$setOrderBy[$sort]." DESC";
                }
            }
        }

        if ($foundNotEmptyValue) {
            $qb = "SELECT * FROM obivlenie WHERE $strParam = :$strParam";

            $params = [$strParam => $paramSearch[$strParam] ];
            foreach ($paramSearch as $key => $value) {
                if ((!in_array($key, [$strParam, 'sorting'])) and (!empty($paramSearch[$key]))) {
                    if ($key == "obshaya_ploshad") {
                        $qb = $qb." AND ".$key." ".$setrange[$value];
                        $flag = $value;
                    } else {
                        $qb = $qb ." AND ".$key."= :".$key;
                        $params += [ $key => $value];
                    }
                }
            }
            if (Auth::check()) {
                $qb = $qb. " AND user_id <> ".Auth::user()->id;
            }
            $qb = $qb." ORDER BY ".$setOrderBy[$sort]." DESC";
            $houses = DB::select(DB::raw($qb), $params);
        } else {
            if (Auth::check()) {
                $qb = $qb. " AND user_id <> ".Auth::user()->id;
            }
            $houses = DB::select(DB::raw($qb));
        }

        if (!empty($paramSearch['obshaya_ploshad'])) {
            $paramSearch['obshaya_ploshad'] = $flag ;
        }


        $foundelemts = count($houses);
        return View('pages.properties_listing_lines', compact('houses', 'foundelemts', 'paramSearch'));
    }

    private function setparamsSearch($paramSearch)
    {

        $authValues = [11, 12];

        $cities = [3, 4];
        if (("11" == $paramSearch["district"])) {
            $paramSearch["district"]= "";
        } elseif (in_array($paramSearch["city"], $cities)) {
            if (!in_array($paramSearch["district"], $authValues)) {
                $paramSearch["district"]= "";
            }
        }

        return $paramSearch["district"];
    }

    public function extractUserRequestData(Request $request)
    {


        //create a new instance of MenahouseSearchEngine to perform search
        $menahousefinder = new MenahouseSearchEngine ;
        $term = [];
        $params = [];

        $paramSearch = Input::except('_token', 'rangeMin', 'rangeMax');

        $maxrange = Input::get('rangeMax');
        $minrange = Input::get('rangeMin');

        $setRange =  "BETWEEN " .$minrange.
                     " AND ". $maxrange;
        $paramSearch += ['obshaya_ploshad' => $setRange];
        $params += ['status' => $paramSearch['status']];

        $paramSearch["district"] = $this->setparamsSearch($paramSearch);

        $matchParamValues = function ($paramName, $paramKey) {
              $all = ['Все города', 'Все округа', 'Все районы'];

              $queryParam = [

                  "city" => [
                      "1" => "Все города",
                      "2" => "Москва",
                      "3" => "Московская область",
                      "4" => "Новая Москва"
                  ],

                  "district" => [
                      "0" => "Все округа",
                      "1" => "Центральный",
                      "2" => "Северный",
                      "3" => "Северо-Восточный",
                      "4" => "Восточный",
                      "5" => "Юго-Восточный",
                      "6" => "Южный",
                      "7" => "Юго-Западный",
                      "8" => "Западный",
                      "9" => "Северо-Западный",
                      "10" => "Зеленоградский",
                      "11" => "Все районы",
                      "12" => "Троицкий"
                  ],

                  "propertytype" => [
                        "1" => "Квартира",
                        "2" => "Комната",
                        "3" => "Частный дом",
                        "4" => "Новостройки"
                  ],

                  "mestopolozhenie_obmena" => [
                      "1" => "В_другом_районе",
                      "2" => "В_своём_районе"
                  ],

                  "room" => [
                    "1" => "1",
                    "2" => "2",
                    "3" => "3",
                    "4" => "4",
                    "5" => "5"
                  ],

                  // en fonction du critere de recherche prendre le contraire
                  // tseli_obmena == На увеличение ns retournons ttes les offres qui ont
                  // tseli_obmena == На уменьшение
                  // <select name="tseli_obmena">
                  //     <option value="">Обмен на</option>
                  //     <option value="1">На увеличение</option>
                  //     <option value="2">На уменьшение</option>
                  // </select>
                  //

                  "tseli_obmena" => [
                      "1" => "На_уменьшение",
                      "2" => "На_увеличение"
                  ]

              ];

              $q = function () use ($paramName) {

                 $qt = [
                            "city" => "gorod",
                            "district" => "rayon",
                            "propertytype" => "type_nedvizhimosti",
                            "tseli_obmena" => "tseli_obmena",
                            "room" => "kolitchestvo_komnat",
                            "mestopolozhenie_obmena" => "mestopolozhenie_obmena"
                      ];
                 return $qt[$paramName];
              };

            foreach ($queryParam as $queryParamKey => $queryParamValue) {
                //  $qr = "";
                if ($queryParamKey == $paramName) {
                    if (!in_array($queryParamValue[$paramKey], $all)) {
                        return  ["1" => $q($paramName), "2" => $queryParamValue[$paramKey]];
                    }
                }
            }

            //  return $qr ;
        };


        foreach ($paramSearch as $key => $value) {
            if ((!in_array($key, ['_token'])) and (!empty($paramSearch[$key]))) {
                if ($key == 'obshaya_ploshad') {
                    $params += [ 'obshaya_ploshad'  => $setRange];
                } elseif ($key == 'propertytype') {
                    $params += [ 'type_nedvizhimosti'  => $value];
                } else {
                    $qv = $matchParamValues($key, $value);
                    if (!is_null($qv)) {
                        $params += [ $qv['1'] => $qv['2']];

                        ///===  request parameters for elasticsearch
                        $term += [ $qv['1'] => $qv['2']];
                    }
                }
            }
        }


        $menahousefinder = new MenahouseSearchEngine ;
        $params += ['typerequest' => '2'];

        $menahousefinder::SetQuerySearch($params);

        return redirect('search-results');
    }

    public function searchengine(Request $request)
    {

      ///=== TODO :  архитектура для высокой нагрузски на AWS

      //create a new instance of MenahouseSearchEngine to performing search
        $menahousefinder = new MenahouseSearchEngine ;
        $term = [];
        $range = [];

        $paramSearch = Input::except('_token', 'rangeMin', 'rangeMax');

        $maxrange = Input::get('rangeMax');
        $minrange = Input::get('rangeMin');
        $rangeIsSet = true;

        $setRange =  "BETWEEN " .$minrange.
                   " AND ". $maxrange;
        $paramSearch += ['obshaya_ploshad' => $setRange];



      //
      // if (("20" != $minrange) || ("100" != $maxrange)) {
      //
      //    $setRange =  "BETWEEN " .$minrange.
      //                 " AND ". $maxrange;
      //    $paramSearch += ['obshaya_ploshad' => $setRange];
      //    $rangeIsSet = true;
      // }



        if (("11" != $paramSearch["district"])  &&
          ("Московская область" != $paramSearch["city"])) {
            $paramSearch["district"] = "";
        }


        $matchParamValues = function ($paramName, $paramKey) {
            $all = ['Все города', 'Все округа', 'Все районы'];

            $queryParam = [

                "city" => [
                    "1" => "Все города",
                    "2" => "Москва",
                    "3" => "Московская область",
                    "4" => "Новая Москва"
                ],

                "district" => [
                    "0" => "Все округа",
                    "1" => "Центральный",
                    "2" => "Северный",
                    "3" => "Северо-Восточный",
                    "4" => "Восточный",
                    "5" => "Юго-Восточный",
                    "6" => "Южный",
                    "7" => "Юго-Западный",
                    "8" => "Западный",
                    "9" => "Северо-Западный",
                    "10" => "Зеленоградский",
                    "11" => "Все районы",
                    "12" => "Троицкий"
                ],

                "propertytype" => [
                      "1" => "Квартира",
                      "2" => "Комната",
                      "3" => "Частный дом",
                      "4" => "Новостройки"
                ],

                "mestopolozhenie_obmena" => [
                    "1" => "В_другом_районе",
                    "2" => "В_своём_районе"
                ],

                "room" => [
                  "1" => "1",
                  "2" => "2",
                  "3" => "3",
                  "4" => "4",
                  "5" => "5"
                ],

                // en fonction du critere de recherche prendre le contraire
                // tseli_obmena == На увеличение ns retournons ttes les offres qui ont
                // tseli_obmena == На уменьшение
                // <select name="tseli_obmena">
                //     <option value="">Обмен на</option>
                //     <option value="1">На увеличение</option>
                //     <option value="2">На уменьшение</option>
                // </select>
                //

                "tseli_obmena" => [
                    "1" => "На_уменьшение",
                    "2" => "На_увеличение"
                ]

            ];

            $q = function () use ($paramName) {

                $qt = [
                          "city" => "gorod",
                          "district" => "rayon",
                          "propertytype" => "type_nedvizhimosti",
                          "tseli_obmena" => "tseli_obmena",
                          "room" => "kolitchestvo_komnat",
                          "mestopolozhenie_obmena" => "mestopolozhenie_obmena"
                    ];
                return $qt[$paramName];
            };

            foreach ($queryParam as $queryParamKey => $queryParamValue) {
                //  $qr = "";
                if ($queryParamKey == $paramName) {
                    if (!in_array($queryParamValue[$paramKey], $all)) {
                        return  ["1" => $q($paramName), "2" => $queryParamValue[$paramKey]];
                    }
                }
            }

            //  return $qr ;
        };

        $statval = $paramSearch['status'];
        $term += ['status' => $paramSearch['status']];

        $qb = "SELECT * FROM obivlenie WHERE status = :status";

        $params = ['status' => $paramSearch['status'] ];
        foreach ($paramSearch as $key => $value) {
            if ((!in_array($key, ['_token', 'status']))
             and (!empty($paramSearch[$key]))) {
                if (($key == "obshaya_ploshad") && ($rangeIsSet == true )) {
                      $qb = $qb." AND ".$key." ".$setRange;
                      $flag = $value;
                } else {
                        $qv = $matchParamValues($key, $value);
                    if (!is_null($qv)) {
                        $qb = $qb ." AND ".$qv['1']."= :".$qv['1'];
                        $params += [ $qv['1'] => $qv['2']];


                      ///===  request parameters for elasticsearch
                        $term += [ $qv['1'] => $qv['2']];
                    }
                }
            }
        }

        if (Auth::check()) {
            $qb = $qb. " AND user_id <> ".Auth::user()->id;
        }

        $houses = DB::select(DB::raw($qb), $params);

        if (!empty($paramSearch['obshaya_ploshad'])) {
            $paramSearch['obshaya_ploshad'] = $flag ;
        }

      // $houses = $menahousefinder->getIndexedElements($paramSearchEngine);
        $foundelemts = count($houses);

        return View('pages.properties_listing_lines', compact('houses', 'foundelemts', 'paramSearch'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $indexmodel = new MenahouseSearchEngine;
        $Helper = new CustomHelper;
        $StoragePath = $Helper->getStorageDirectory();

        // $excludeKeyValues = array("file-upload", "_token");

      // $address =  Input::get('address');
        $updateparams = [];
        $params = [];
      //
      // if (!empty($address)) {
      //     $geo = $Helper->yandexGeocoding($address);
      //     $updateparams = array('rayon' => $Helper->getDistritcs($geo['address'][0]) );
      //     $ar = explode(" ", $geo['metro'][0]);
      //     $metro = '';
      //     foreach ($ar as $key => $value) {
      //       if ($ar[$key] != 'метро') {
      //         $metro = $metro.' '.$value;
      //       }
      //     }
      //     $updateparams += array('metro' => trim($metro) );
      // }

        $inputall = Input::except('_token');

         foreach ($inputall as $key => $value) {

            if (!empty($value))   {
                $params += [$key => $value ];

            } // fin if
         } // fin foreach


        $house = Obivlenie::where('id', Input::get('id'))->update($params);
        // dd($house);

        // if ($request->hasFile('file-upload')){

        
        //             $madeThumnail = false ;
        //             $pictures = $request->file('file-upload');

        //            // $affectedRows = Images::where('imageable_id', '=', $updateparams['id'])->delete();
        //             foreach ($request->file('file-upload') as $imgvalue) {
        //                 $filename = Str::random(32).'.'.$imgvalue->guessClientExtension();
        //                 // $filePath = 'dev/images/pics/' .$filename;

        //                 if ($imgvalue->isValid()) {
        //                 // dd($imgvalue);

        //                     $img = new Images ;
        //                     $img = $house->images()->create(array('path' => $filename));

        //                     $imgvalue->move($StoragePath["storage"], $filename);
        //                     $house->images()->save($img);

        //                     if (! $madeThumnail) {
        //                         $thumbnailName = $updateparams['id'].'.'.$imgvalue->guessClientExtension();

        //                         $ThumbNail = ThumbNail::where('obivlenie_id', '=', $updateparams['id'])->delete();
        //                         $ThumbNail = ThumbNail::create([
        //                         'obivlenie_id' => $updateparams['id']
        //                         ]);

        //                         $thumbImag = new Images;
        //                         $thumbImag = $ThumbNail->images()->create(array('path' => $thumbnailName));

        //                         File::copy($StoragePath["storage"].'/'.$filename, $StoragePath["thumbs"].'/'.$thumbnailName);
        //                         $ThumbNail->images()->save($thumbImag);

        //                         $madeThumnail = true ;
        //                 }
        //             }
        //         }

        //    }

     // $response = $indexmodel->updateIndexedElement($updateparams);

      // tout est ok nous retourner une a la page des publications
        return Redirect('me/obyavlenie');
    }
    public function getAllProperties()
    {

        $paramSearch = array('gorod' => 'Москва');
        if (Auth::check()) {
            $houses = Obivlenie::where('gorod', '=', 'Москва')
            ->where('user_id', '<>', Auth::user()->id )
            ->get();
        }
        $houses = Obivlenie::where('gorod', '=', 'Москва')->get();


        $foundelemts = $houses->count();

        return redirect('/');

        return View('pages.properties_listing_lines', compact('houses', 'foundelemts', 'paramSearch'));
    }

    /**
     * get all resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCatalogue(Request  $request)
    {

      //  menahouseUserQuery

        $paramSearch = Input::except('_token');
        $menahousefinder = new MenahouseSearchEngine() ;
        $paramSearch += ['typerequest' => '2'];
        $menahousefinder::SetQuerySearch($paramSearch);

        return  redirect('search-results');
    }

    /**
     * get the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchInCatalogue()
    {
        return View('house.catalogue', []);
    }

    public function destroy($id)
    {


        $obj = Obivlenie::whereid($id)->first();

      
        if (Auth::user()->id == $obj->user_id) {
            Obivlenie::destroy($id);
        }
        return Redirect('/me/obyavlenie');
    }

    public function destroyObj($id)
    {
      //$obj = Bookmarked::whereid($id)->first();

        $user_id = Auth::id() ;

        $del = DB::table('bookmarked')->where(['obivlenie_id' => $id, 'user_id' => $user_id ])
                                    ->delete();

        Cache::forget('favoris_user_'.$user_id);

        return Redirect()->back();
    }


    public function deleteItemFromFavoris($id)
    {
        $favoris = DB::table('bookmarked')->where('id', '=', $id)->get();
        $favoris->deleted = '1';
        $favoris->save();
        return Redirect('me/obyavlenie');
    }

    public function getCategoriesById($categorie)
    {
        $allcategorie = Categorie::wherename($categorie)->get();
        return $allcategorie[0]->id ;
    }

    public function deleteImg($img)
    {
        $img->delete;
    }

    public function uploadThumbImagtoCloudStorage($thumbnail, $thumbnailName)
    {
        $CloudStorage = Storage::disk('s3');

        $filePath = 'dev/thumbs/' .$thumbnailName;
        $CloudStorage->put($filePath, file_get_contents($thumbnail), 'public');
    }

    public function getItemsCollections()
    {
        $menahousefinder = new MenahouseSearchEngine() ;
        $houses = $menahousefinder::getItemsCatalogue();

        return json_encode($houses) ;
    }

    public static function makeLengthAware($collection)
    {
        $perPage = 5;
        $paginator = new LengthAwarePaginator(
        $collection,
        $collection->count(),
        $perPage,
        Paginator::resolveCurrentPage(),
        ['path' => Paginator::resolveCurrentPath()]);

        return str_replace('/?', '?', $paginator->render());
    }

    public static function paginateResults(Collection $items)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage() ?: 1;
        $maxClientPerPage = 2;
        $startIndex = ($currentPage * $maxClientPerPage) - $maxClientPerPage;
        $paginatedClients = Collection::make($items)->slice($startIndex, $maxClientPerPage);

       /*
        * Eager load orders for each client, but we don't want those cached.
        */
        if (!$paginatedClients->isEmpty()) {
            $query = $paginatedClients->first()->newQuery();
            $paginatedClients = Collection::make($query->eagerLoadRelations($paginatedClients->all()));
        }

        return new LengthAwarePaginator(
           $paginatedClients,
           $items->count(),
           $maxClientPerPage,
           $currentPage,
           [
               'path' => LengthAwarePaginator::resolveCurrentPath(),
           ]
        );
    }
}






        // $TYPE_OBJECT = ['Комната', 'Частный дом'];
        // $submit_property = Input::get('property-type');

        // $submit_location = Input::get('city');
        // if ("" ==  $submit_location) {
        //     $submit_location = '2';
        // }


        // $property_type = function($submit_property){

        //       $properties = [
        //                       '1' => 'Квартира',
        //                       '2' => 'Комната',
        //                       '3' => 'Частный дом',
        //                       '4' => 'Новостройки'
        //                     ];

        //       return  $properties[$submit_property];

        // };

        // $getLocation = function($submit_location){

        //       $location = [
        //                       '1' => '*',
        //                       '2' => 'Москва',
        //                       '3' => 'Московская область',
        //                       '4' => 'Новая Москва'
        //                     ];

        //       return $location[$submit_location];

        // };


        // $kolitchestvo_komnat = Input::get('room');
        // $pt = $property_type($submit_property);
        // if (in_array($pt, $TYPE_OBJECT)) {
        //   $kolitchestvo_komnat = null;
        // }

        // if ( "Московская область" == $getLocation($submit_location)) {
        //   $setDistrict = "-";
        // }else {
        //   $setDistrict = $Helper->getDistrict(Input::get('district'));
        // }

        // $address =  Input::get('address');
        //
        // $geo = $Helper->yandexGeocoding($address);
        //
        // $district = $Helper->getDistritcs($geo['address'][0]);
        //
        // $ar = explode(" ", $geo['metro'][0]);
        // $metro = '';
        // foreach ($ar as $key => $value) {
        //   if ($ar[$key] != 'метро') {
        //     $metro = $metro.' '.$value;
        //   }
        // }


        // $obivlenie = obivlenie::create([
        //     // 'adressa' => $adressa,
        //     'metro' => Input::get('submit-metro'),
        //     'gorod' =>  $getLocation($submit_location),
        //     'ulitsa' => Input::get('submit-address'),
        //     /*'dom' => Input::get('dom'),
        //     'address' => $address,
        //     'vicota_patolka' => Input::get('roof')
        //     */
        //     'type_nedvizhimosti' => $property_type($submit_property),
        //     'tekct_obivlenia' => Input::get('submit-description'),
        //     'kolitchestvo_komnat' => $kolitchestvo_komnat,
        //     'etajnost_doma' => Input::get('submit-etajnost_doma') ,
        //     'zhilaya_ploshad' => Input::get('zhilaya_ploshad') ,
        //     'obshaya_ploshad' => Input::get('obshaya_ploshad') ,
        //     'ploshad_kurhni' => Input::get('ploshad_kurhni') ,
        //     'rayon' => $setDistrict,
        //     'roof' => Input::get('roof-size'),
        //     'etazh' => Input::get('submit-etazh'),
        //     'san_usel' => Input::get('submit-Baths'),
        //     'title' => Input::get('title'),
        //     'price' => Input::get('predpolozhitelnaya_tsena') ,
        //     'status' => Input::get('submit-status'),
        //     'tseli_obmena' => Input::get('submit-tseli-obmena'),
        //     'mestopolozhenie_obmena' => Input::get('mestopolozhenie_obmena'),
        //     'doplata' => Input::get('doplata'),
        //     'numberclick' => 0,
        //   //  'predpolozhitelnaya_tsena' => Input::get('predpolozhitelnaya_tsena'),
        //     'user_id' => $user_id,
        // ]);




          // indexer  la publication dans elasticsearch
        //  $params = [
        //       'index' => 'menahouse',
        //       'type' => 'obivlenie',
        //       'id' => $obivlenie->id,
        //       'body' =>[
        //         'id' => $obivlenie->id,
        //         'metro' => $obivlenie->metro,
        //         'gorod' =>  $obivlenie->gorod,
        //         'ulitsa' => $obivlenie->ulitsa,
        //         'type_nedvizhimosti' => $obivlenie->type_nedvizhimosti,
        //         'rayon' => $obivlenie->rayon,
        //         'tekct_obivlenia' => $obivlenie->tekct_obivlenia,
        //         'kolitchestvo_komnat' => $obivlenie->kolitchestvo_komnat,
        //         'etajnost_doma' => $obivlenie->etajnost_doma,
        //         'zhilaya_ploshad' => $obivlenie->zhilaya_ploshad,
        //         'obshaya_ploshad' => $obivlenie->obshaya_ploshad,
        //         'ploshad_kurhni' => $obivlenie->ploshad_kurhni,
        //         'etazh' => $obivlenie->etazh,
        //         'san_usel' => $obivlenie->san_usel,
        //         'price' => $obivlenie->price,
        //         // 'opicanie' => $obivlenie->opicanie,
        //         // 'status' => 'availabe',
        //         'user_id' => $user_id,
        //         'roof' => $obivlenie->roof,
        //         // 'title' => $obivlenie->title,
        //         'status' => $obivlenie->status,
        //         'tseli_obmena' => $obivlenie->tseli_obmena,
        //         'mestopolozhenie_obmena' => $obivlenie->mestopolozhenie_obmena,
        //         'doplata' => $obivlenie->doplata
        //       ]
        //   ];

        // $indexmodel->ModelMapping($params);
