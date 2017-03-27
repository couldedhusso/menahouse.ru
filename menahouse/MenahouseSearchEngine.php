<?php namespace Menahouse ;

use Elasticsearch;
use Elasticsearch\Client;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Session\Store as SessionStore;

use App\User;
use App\Obivlenie;
use Menahouse\CustomHelper;

use Auth ;
use DB;
use Session;

class MenahouseSearchEngine
{

  // connection by ssl on my AWS
  // var client = new elasticsearch.Client({
  //   hosts: [
  //     'https://box1.internal.org',
  //     'https://box2.internal.org',
  //     'https://box3.internal.org'
  //   ],
  //   ssl: {
  //     ca: fs.readFileSync('./cacert.pem'),
  //     rejectUnauthorized: true
  //   }
  // });

  private $session;
  private $container;
  private $searchquery;

  private $hosts = ['127.0.0.1:9200'];
  private $client ;

  public function __construct()
  {

  //  $this->session =  Session;
    $this->container = 'Menahouse_search_Query';


    $this->client = Elasticsearch\ClientBuilder::create()
                ->setHosts($this->hosts)
                ->build();

    $this->InitQueryContainer();
  }

  private function InitQueryContainer(){

  }

  private function inserQuerySearchToContainer(){

  }

  private function updatQuerySearchContainer(){
  //  ,$this->session->get($this->container)
    array_set($this->searchquery, $this->container, null);
  }

  public function ModelMapping($params)
  {
      $reponse = $this->client->index($params) ;
      return $reponse ;
  }

  public function updateIndexedElement($params){


        $params = [
          'index' => 'menahouse',
          'type' => 'obivlenie',
          'id' => $params['id'],
          'body' => [
            'doc' => $params
          ]
      ];
      $response = $this->client->update($params);
      return $response;
  }

  public function getIndexedElements($queryParameters){

      $paramTerm = $queryParameters["term"];
      $must = [];
      if (isset($queryParameters["range"])) {
        $paramRange = $queryParameters["range"];
      }
      if (count($paramTerm) == 1) {
           $searchConditons["bool"]["must"] =
           ["match"  => ["gorod" => $paramTerm["gorod"]]];
           if ( isset($paramRange) ) {

              array_push($searchConditons["bool"]["must"],
                          ["range" => ["obshaya_ploshad"
                           => $this->createRangeQuery($paramRange)]]);
           }
      } else {

          foreach (array_keys($paramTerm) as $key) {
            array_push($must, ["match" => [$key => $paramTerm[$key]]]);
          }

          $searchConditons = [ "bool" => [ "must" => $must ]];
          if ( isset($paramRange) ) {

             array_push($searchConditons["bool"]["must"],
                         ["range" => ["obshaya_ploshad"
                          => $this->createRangeQuery($paramRange)]]);
          }

      }

      $params = [
          "index" => "menahouse",
          "type" => "obivlenie",
          "body" => [
              "query" => [
                  "filtered" => [
                      "query" => ["match_all" => []],
                      "filter" => $searchConditons
                   ]
              ]
        ]];

      // dd($params) ;

        $results = $this->client->search($params);   // Execute the search
        return $this->buildCollection($results) ;
  }

  public function getSortedIndexedElements($queryParameters, $paramSort){

    $params = [
        "index" => "menahouse",
        "type" => "obivlenie",
        "body" => [
            "query" => [
                "filtered" => [
                    "query" => ["match_all" => []],
                    "filter" => $searchConditons
                 ]
            ],
            "sort" => [
                $paramSort => ["order" => "desc"]
            ]
      ]];

      //  dd($params) ;

      $results = $this->client->search($params);   // Execute the search
      return $this->buildCollection($results) ;
  }


   public function createRangeQuery($xrange){
     $range = [];

     foreach (array_keys($xrange) as $key) {
         array_push($range, [$key => $xrange[$key]]);
     }

     return $range;
   }

   public function getIndexedElementsByid($Id, $typeDocument){
      if ($typeDocument == "images") {
        $conditionSearch = ["imageable_id" => $Id ];
      } else {
        $conditionSearch = ["id" => $Id ];
      }

      $filter["bool"]["must"]["match"] = $conditionSearch;

      $params = [
          "index" => "menahouse",
          "type" => "$typeDocument",
          "body" => [
              "query" => [
                  "filtered" => [
                      "query" => ["match_all" => []],
                      "filter" => $filter
                   ]
              ]
        ]];

        $searchresults = $this->client->search($params);   // Execute the
        dd($results);

        $result = collect();
        foreach ($searchresults as  $value) {
            $ads = new Obivlenie();
            $ads->metro = $value["_source"]["metro"];
            $ads->gorod = $value["_source"]["gorod"];
            $ads->ulitsa = $value["_source"]["ulitsa"];
            $ads->dom = $value["_source"]["dom"];
            $ads->rayon = $value["_source"]["rayon"];
            $ads->stroenie = $value["_source"]["stroenie"];
            $ads->etazh = $value["_source"]["etazh"];
            $ads->type_nedvizhimosti = $value["_source"]["type_nedvizhimosti"];
            $ads->kolitchestvo_komnat = $value["_source"]["kolitchestvo_komnat"];
            $ads->tekct_obivlenia = $value["_source"]["tekct_obivlenia"];
            $ads->etajnost_doma = $value["_source"]["etajnost_doma"];
            $ads->zhilaya_ploshad = $value["_source"]["zhilaya_ploshad"];
            $ads->obshaya_ploshad = $value["_source"]["obshaya_ploshad"];
            $ads->ploshad_kurhni = $value["_source"]["ploshad_kurhni"];
            $ads->san_usel = $value["_source"]["san_usel"];
            $ads->price = $value["_source"]["price"];
            //$ads->opicanie = $value["_source"]["opicanie"];
            $ads->status = $value["_source"]["status"];
            $ads->user_id = $value["_source"]["user_id"];
            $ads->id = $value["_source"]["id"];
            $ads->status = $value["_source"]["status"];
          //  $ads->categorie_id = $value["_source"]["categorie"];

            $houses->push($ads);

        }

        return $results->Paginate(6);
   }


   private function buildCollection($items){
      $result  = $items['hits']['hits'];
      return Collection::make(array_map(function ($value)
      {
          $ads = new Obivlenie();
          $ads->newInstance($value['_source'], true);
          $ads->setRawAttributes($value['_source'], true);
          return $ads ;
      }, $result));
   }

   private function getIdFoundElements($items){
        $result = $items['hits']['hits'];
        $id = new Collection() ;
        foreach ($result['_source'] as $value) { $id->push($value['id']); }
        return $id ;
   }


   public static function getItemsCatalogue(){


     $queryParameters = Session::get('menahouseUserQuery');

    //  if ($queryParameters['typerequest'] == 1) {
    //        $houses = DB::table('obivlenie')->where('kolitchestvo_komnat', '=',
    //                                        $queryParameters['numberroom'])->get();
    //
    //         return $houses;
    //  }

    /// dd($queryParameters);

    if ($queryParameters['typerequest'] == '1') {
      if (Auth::check()) {
        $houses  = DB::table('obivlenie')->where('kolitchestvo_komnat', '>=', '4')
                                              ->OrWhere('type_nedvizhimosti', '=','Комната')
                                              ->where('user_id', '!=', $userID)
                                              ->get();

      } else {
           $houses  = DB::table('obivlenie')->where('kolitchestvo_komnat', '>=', '4')
                                              ->OrWhere('type_nedvizhimosti', '=','Комната')
                                              ->get();
      }


        return $houses;

    } else {

     $foundNotEmptyValue = false;

     foreach ($queryParameters as $key => $value) {
       if (!empty($value)) {
             $strParam = $key;
             $foundNotEmptyValue = true;
             break;
       }
     }

   //  ElasticSearchEngine

     if ($foundNotEmptyValue) {


       $qb = "SELECT * FROM obivlenie WHERE $strParam = :$strParam";

       $params = [$strParam => $queryParameters[$strParam] ];
       foreach ($queryParameters as $key => $value) {
         if (!in_array($key, [$strParam, 'typerequest', 'obshaya_ploshad']) AND (!empty($queryParameters[$key]))) {
                 $qb = $qb ." AND ".$key."= :".$key;
                 $params += [ $key => $value];
               }
         if (($key == "obshaya_ploshad") ) {
                   $qb = $qb." AND ".$key." ".$value;
               }
       }

       if (Auth::check()) {
           $qb = $qb. " AND user_id <> ".Auth::user()->id;
           $houses = DB::select(DB::raw($qb), $params);
       } else {
         $houses = DB::select(DB::raw($qb), $params);
       }
       // $qb = $qb." ORDER BY ".$setOrderBy[$sort]." DESC";

     } else {

         $qdb = "SELECT * FROM obivlenie";
         $houses = DB::select(DB::raw($qdb));
         // $queryParameters['gorod'] = "Москва";
     }

    //  dd($houses);

      return $houses ;
    }
  }

  public static function SetQuerySearch($queryParameters){
    Session::put('menahouseUserQuery', $queryParameters);
  }



}
