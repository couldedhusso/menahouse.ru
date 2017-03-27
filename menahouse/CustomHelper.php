<?php namespace Menahouse ;

  use Illuminate\Support\Facades\File;
  use Illuminate\Support\Facades\Input;
  use Illuminate\Http\Request;
  use Illuminate\Contracts\Filesystem\Filesystem;
  use Yandex\Geo;
  use Hashids\Hashids;
  use Redis;
  use DB;
  use App\User;

  // require "predis/autoload.php";
  // Predis\Autoloader::register();
  use  \Firebase\JWT\JWT;
  use Carbon\Carbon;

  /**
   *
   */
  class CustomHelper
  {

    private $yandex_api;

    public function __construct(){
      $this->yandex_api = new \Yandex\Geo\Api();
    }

    private function redisSet($db_param){
      return [
          'scheme'   => 'tcp',
          'host'     => '127.0.0.1',
          'port'     => 6379,
          'database' => $db_param
      ];
    }

    private function createToken($user){

        $issuedAt   = time();
        // $expire     = $issuedAt + 60; // 30 * 24 * 60 * 60 license d essai pour 1 mois
        $expire     = $issuedAt +  30 * 24 * 60 * 60; //license d essai pour 1 mois

        /*
         * Create the token as an array
         */
        $payload = [
            'iat'  => $issuedAt,                                     // Issued at: time when the token was generated
            'exp'  => $expire,                                     // Expire
            'sub' => [                                            // Data related to the signer user
                'userId'   => $user->id,
                'userMail' => $user->email,
            ]
        ];

        return \Firebase\JWT\JWT::encode($payload, env('JWT_KEY'), 'HS256');

    }

    private function redisClientSet($db){

      //===  https://github.com/antirez/retwis/blob/master/retwis.php

      static $rc = false ;
      if ($rc) return $rc;
      $rc = new Predis\Client($this->redisSet($db));
    }

    public function setUserPlanToken($user){
        // definisons le client redis
        // par default ns utiliserons le db 0 pour les licenses user

        // $getUser = DB::table('users')->where('id', '=', $user->id)->first();

        $getUser = User::where('id', '=', $user->id)->first();
        if (!Redis::hget("users:$user->id", "payload")) {
            $payload = $this->createToken($user);
            $getUser->payload = $payload;
            $getUser->save();
            Redis::hset("userpass:$user->id", "payload", "$payload");
        }

      //  dd(Redis::hget("userpass:$user->id", "payload"));
    }

    public function encodeId($id){

        $hashid = new Hashids('', 10);
        return $hashid->encode($id);
    } 

     public function decodeId($id){
        $hashid = new Hashids();
        return $hashid->decode($id);
    } 

    public function getUserPlanPass($user){
        // definisons le client redis
        // par default ns utiliserons le db 0 pour les licenses user

        $token = Redis::hget("users:$user->id", "payload");
        if ($token) {
           $payload = (array) \Firebase\JWT\JWT::decode($token, env('JWT_KEY'), ['HS256']);
           if ($payload['exp'] < time()) {
               return true ;
              //  response()->json(['message' => 'Token has expired']);
           }
         }
         return false ;

      //  dd(Redis::hget("userpass:$user->id", "payload"));
    }

    public function yandexGeocoding($searchParams){

      // TODO : mettre en cache le result de recherche

      // поиск по адресу объекта
      $this->yandex_api->setQuery($searchParams);

      // Настройка фильтров
      $this->yandex_api
          ->setLimit(1) // кол-во результатов
          ->setLang(\Yandex\Geo\Api::LANG_US) // локаль ответа
          ->load();

      $response = $this->yandex_api->getResponse();

      // Список найденных точек
      $collection = $response->getList();
      foreach ($collection as $item) {
        $params = array('0' => $item->getLongitude(), // долгота для исходного запроса
                          '1' => $item->getLatitude()); // широта для исходного запроса
      }

      if ($response->getFoundCount()) // something found
      {
          return $this->yandexReverseGeocoding($params);
      }

      return null ;
    }

    public function mappingFields($paramKey, $paramValue){


          $matchParamValues = function($paramKey, $paramValue) {
                // $all = ['Все города', 'Все округа', 'Все районы'];

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

                    "property-type" => [
                          "1" => "Квартира",
                          "2" => "Комната",
                          "3" => "Частный дом",
                          "4" => "Новостройки"
                    ],

                    "room" => [
                      "1" => "1",
                      "2" => "2",
                      "3" => "3",
                      "4" => "4",
                      "5" => "5"
                    ]

                ];

                $res = $queryParam[$paramKey];

                return $res[$paramValue];
        };

        $q = function() use ($paramKey){

           $qt = [
                      "city" => "gorod",
                      "district" => "rayon",
                      "property-type" => "type_nedvizhimosti",
                      // "tseli_obmena" => "tseli_obmena",
                       "room" => "kolitchestvo_komnat",
                      // "mestopolozhenie_obmena" => "mestopolozhenie_obmena"
                ];
           return $qt[$paramKey];
        };

        return  [
          '1' => $q($paramKey),
          '2' => $matchParamValues($paramKey, $paramValue)
        ];
    }

    public function getDistritcs($param)
    {
      switch ($param) {
        case 'Центральный административный округ':
          $district = 'ЦАО';
          break;
        case 'Юго-Западный административный округ':
          $district = 'ЮЗАО';
          break;
        case 'Восточный административный округ':
          $district = 'ВАО';
          break;
        case 'Южный административный округ':
            $district = 'ЮАО';
            break;
        default:
          $district = 'САО';
          break;
      }
      return $district;
    }
    public function yandexReverseGeocoding($params){

        $kind_district = 'KIND_DISTRICT';
        $kind_metro = 'KIND_METRO';

        $getFullAddressParts = $this->setGeocoding($params, $kind_district);
        $getMetroParts = $this->setGeocoding($params, $kind_metro);

        return  [
            'address' => $getFullAddressParts,
            'metro' => $getMetroParts
        ];
    }

    private static function setStorageDirectory($DirectoryName)
    {
        File::makeDirectory($DirectoryName);
        return true;
    }
    public function getStorageDirectory()
    {

      $storagePath = public_path().'/storage/pictures';
      $thumbnailsStoragePath = public_path().'/storage/thumbnail';

       if(! File::exists($storagePath)) {
          $ret =  $this->setStorageDirectory($storagePath);
       }

       if(! File::exists($thumbnailsStoragePath)) {
           $ret = $this->setStorageDirectory($thumbnailsStoragePath);
       }

       return
       [
         /*
         |----------------------------------------------------------------------
         | Repertoire des images de tailles normales
         |----------------------------------------------------------------------
         */
         "storage" => $storagePath,
         /*
         |----------------------------------------------------------------------
         | Repertoire des images de tailles reduitess
         |----------------------------------------------------------------------
         */
         "thumbs" => $thumbnailsStoragePath
       ];
    }

    private function setGeocoding(array $params, $kind)
    {

      $geoData = [];
      $this->yandex_api->setPoint($params[0], $params[1]);

      if ($kind == 'KIND_METRO') {
        $this->yandex_api
            ->setLimit(1) // кол-во результатов
            ->setLang(\Yandex\Geo\Api::LANG_RU) // локаль ответа
            ->setKind(\Yandex\Geo\Api::KIND_METRO)
            ->load();
      }
      else {
        $this->yandex_api
            ->setLimit(1) // кол-во результатов
            ->setLang(\Yandex\Geo\Api::LANG_RU) // локаль ответа
            ->setKind(\Yandex\Geo\Api::KIND_DISTRICT)
            ->load();
      }

      $response = $this->yandex_api->getResponse();

      // Список найденных точек
      $collection = $response->getList();
        foreach ($collection as $item) {
          if($kind == 'KIND_DISTRICT'){
            $fulladr = $item->getFullAddressParts();
              array_push($geoData, $fulladr[3]); // getAdministrativeAreaName
              array_push($geoData, $fulladr[4]); // getSubAdministrativeAreaName
          } else{
              array_push($geoData, $item->getMetro()); // getMetroName
          }
      }
      return $geoData ;
    }

    public function getLocation($index){
        switch ($index) {
          case '2':
            $gorod = "Московская область";
            break;
          case '3':
            $gorod = "Новая Москва";
            break;
          default:
            $gorod = "Москва";
            break;
        }
        return $gorod ;
    }

    public function getDistrict($index){
      switch ($index) {
        case '1':
              $district = "Центральный";
              break;
        case '2':
              $district = "Северный";
              break;
        case '3':
              $district = "Северо-Восточный";
              break;
        case '4':
              $district = "Восточный";
              break;
        case '5':
              $district = "Юго-Восточный";
              break;
        case '6':
              $district = "Южный";
              break;
        case '7':
              $district = "Юго-Западный";
              break;
        case '8':
              $district = "Западный";
              break;

        case '9':
              $district = "Северо-Западный";
              break;
        case '10':
              $district = "Зеленоградский";
              break;
        case '11':
              $district = "-";
              break;
        case '12':
              $district = "Новомосковский АО";
              break;
       case '13':
             $district = "Троицкий АО";
             break;

      }
      return $district ;
    }


  }
