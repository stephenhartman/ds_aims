<?php

use Faker\Generator as Faker;

$factory->define(App\Alumnus::class, function (Faker $faker) {
    return [

        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone_number' => $faker->phoneNumber,
        'social_pref' => $faker->randomElement($array = array('Twitter', 'Facebook', 'Instagram')),
        'street_address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => $faker->postcode,
        'year_graduated' => $faker->year,
        'volunteer' => $faker->randomElement($array = array(0,1)),
        'loyal_lion' => $faker->randomElement($array = array(0,1))
    ];
});
