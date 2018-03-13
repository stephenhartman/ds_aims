<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Event::class, function (Faker $faker) {

    $unix_timestamp = '1524926067';  // April 28th
    $sd = $faker->dateTimeBetween('now', $unix_timestamp);
    $ed = $faker->dateTimeInInterval($start_date = $sd, $interval = ' + 2 hours');

    return [
        'title' => $faker->catchPhrase,
        'type' => $faker->randomElement($array = array('Volunteer', 'Reunion', 'Community')),
        'start_date' => $sd,
        'end_date' => $ed,
        'description' => $faker->sentence($nbWords = 9, $variableNbWords = true),
        'repeats' => 0,
        'repeat_freq' => 0,
        'repeat_until' => $ed


    ];
});

