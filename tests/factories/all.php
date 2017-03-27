<?php


$factory(App\User::class,  [
        'familia'=> $faker->firstName($gender = 'male'|'female'),
        'imia'=> $faker->name($gender = 'male'|'female'),
        'otchestvo'=> $faker->lastName,
        'email'=> $faker->email,
        'password'=> bcrypt("123"),
        'confirmation_code' => 0,
        'status' => 'activated',
        'phonenumber' => $faker->phoneNumber,
        'remember_token' => str_random(10),
]);



$factory(App\UserMessage::class,  [
        'fromid' => $faker->randomDigit,
        'toid' => 47,
        'body' => $faker->text($maxNbChars = 200),
        'subject' => $faker->sentences($nb = 3, $asText = false),
        'id_obivlenie' => $faker->randomDigit,
        'uuid' => $faker->uuid
]);


$factory(App\Obivlenie::class, [
        
            'metro' => $faker->word,
            'gorod' =>  $faker->numberBetween($min = 1, $max = 3),
            'ulitsa' =>  $faker->address,
            'type_nedvizhimosti' => $faker->numberBetween($min = 1, $max = 4),
            'tekct_obivlenia' => $faker->text,
            'kolitchestvo_komnat' => $faker->numberBetween($min = 1, $max = 5) ,
            'etajnost_doma' =>$faker->numberBetween($min = 5, $max = 20) ,
            'zhilaya_ploshad' => $faker->numberBetween($min = 100, $max = 200) ,
            'obshaya_ploshad' => $faker->numberBetween($min = 100, $max = 500)  ,
            'ploshad_kurhni' => $faker->numberBetween($min = 50, $max = 70) ,
            'rayon' => 1 , /// trouver une autre parade
            'roof' => $faker->randomDigitNotNull,
            'etazh' => $faker->randomDigitNotNull,
            'san_usel' => '-',
            'price' => $faker->numberBetween($min = 1000000, $max = 80000000),
            'status' => $faker->numberBetween($min = 1, $max = 2) ,
            'tseli_obmena' => $faker->numberBetween($min = 1, $max = 2),
            'mestopolozhenie_obmena' => $faker->numberBetween($min = 1, $max = 2),
            'doplata' => 0,
            'numberclick' => 0,
            'user_id' => 'factory:App\User',
]);