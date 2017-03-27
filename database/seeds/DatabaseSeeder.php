<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


use App\City;
use App\District;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

    //     DB::table('categories')->insert([
    //        'name' => 'Аренда'
    //        //'email' => str_random(10).'@gmail.com',
    //       // 'password' => bcrypt('secret'),
    //    ]);

    //    DB::table('categories')->insert([
    //       'name' => 'Продажа'
    //       //'email' => str_random(10).'@gmail.com',
    //      // 'password' => bcrypt('secret'),
    //   ]);


         // $this->call(CityTableSeeder::class);

       //Model::reguard();
       $this->call(AppartTableSeeder::class);



    //    $cities =  ['Москва', 'Московская область', 'Новая Москва'];

    //     $districts = [
    //        'Москва' => ['Центральный', 'Северный', 'Северо-Восточный', 'Восточный',
    //        'Юго-Восточный', 'Южный', 'Юго-Западный', 'Западный', 'Северо-Западный',
    //        'Зеленоградский'
    //        ],
    //        'Московская область' => '-',
    //        'Новая Москва' => ['Новомосковский АО', 'Троицкий АО']
    //    ];


    //    foreach ($cities as  $city) {

    //        $new_city = City::create([
    //             'name' => $city
    //        ]);

    //        foreach ($districts[$city] as  $value) {
    //            District::create([
    //                'name' => $value,
    //                'city_id' => $new_city->id
    //            ]);
    //        }
    //    }
    }
}
