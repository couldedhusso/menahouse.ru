<?php namespace Menahouse\Repositories;

use DB;
use App\City ;
use Cache;
use App\District;
use Menahouse\Contracts\CitiesInterface;

class CitiesRepository implements CitiesInterface
{
   public function getCities(){
       $cacheKey = 'menahouse_cities';
       $minutes = 10;
       return Cache::remember($cacheKey, $minutes, function() {
           return City::select('id', 'name')->get();
       });
   }


   public function getDistricts($id){

       $cacheKey = 'menahouse_districts'.$id;
       $minutes = 10;
       return Cache::remember($cacheKey, $minutes, function() use ($id) {
           return DB::table('districts')->where('city_id', $id)
                      ->select('id', 'name')->get();
       });
   }
}
