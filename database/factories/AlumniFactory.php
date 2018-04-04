<?php

use Faker\Generator as Faker;

$factory->define(App\Alumnus::class, function (Faker $faker) {

    $alumnus = [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone_number' => $faker->phoneNumber,
        'social_pref' => $faker->randomElement($array = array('Twitter', 'Facebook', 'Instagram')),
        'street_address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => $faker->postcode,
        'year_graduated' => $faker->numberBetween($min = 1980, $max = 2018),
        'volunteer' => $faker->randomElement($array = array(0,1)),
        'loyal_lion' => $faker->randomElement($array = array(0,1)),
        'is_parent' => $faker->randomElement($array = array(0,1)),
        'initial_setup' => 1
    ];

    if ($alumnus['is_parent'] == 1)
        $alumnus['parent_name'] = $faker->name;
    return $alumnus;
});
