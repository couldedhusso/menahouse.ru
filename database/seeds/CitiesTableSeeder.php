<?php

use Illuminate\Database\Seeder;
use App\City;
use App\District;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        City::truncate();
        District::truncate();

        $cities =  ['1', '2', '3'];

        $districts = [
           '1' => ['Центральный', 'Северный', 'Северо-Восточный', 'Восточный',
           'Юго-Восточный', 'Южный', 'Юго-Западный', 'Западный', 'Северо-Западный',
           'Зеленоградский'
           ],
           '2' => ['-'],
           '3' => ['Новомосковский', 'Троицкий']
       ];


       foreach ($cities as  $city) {

           $map = ['1' => 'Москва','2' => 'Новая Москва', '3' => 'Московская область'];

           $new_city = City::create([
                'name' => $map[$city]
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
