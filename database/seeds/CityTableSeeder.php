<?php

use Illuminate\Database\Seeder;
use App\City;
use App\District;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cities =  ['Москва', 'Московская область', 'Новая Москва'];

        $districts = [
           'Москва' => ['Центральный', 'Северный', 'Северо-Восточный', 'Восточный',
           'Юго-Восточный', 'Южный', 'Юго-Западный', 'Западный', 'Северо-Западный',
           'Зеленоградский'
           ],
           'Московская область' => '-',
           'Новая Москва' => ['Новомосковский АО', 'Троицкий АО']
       ];


       foreach ($cities as  $city) {

           $new_city = City::create([
                'name' => $city
           ]);

           foreach ($districts[$city] as  $value) {
               District::create([
                   'name' => $value,
                   'city_id' => $new_city->id
               ]);
           }
       }
    
    }
}
