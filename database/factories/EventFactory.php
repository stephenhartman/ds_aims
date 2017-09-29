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

    $unix_timestamp = '1514758421';

    return [
        'name' => $faker->catchPhrase,
        'type' => $faker->randomElement($array = array('Volunteer', 'Reunion', 'Community Event')),
        'date' => $faker->dateTimeBetween('now', $unix_timestamp),
        'time' => $faker->time($format = 'H:i:s'),
    ];
});

