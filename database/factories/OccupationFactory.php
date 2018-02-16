<?php

use Faker\Generator as Faker;

$factory->define(App\Occupation::class, function (Faker $faker) {
    $year = $faker->numberBetween($min = 1990, $max = 2013);
    return [
        'organization' => $faker->company,
        'position' => $faker->jobTitle,
        'start_year' => $year,
        'end_year' => $year + 2,
        'testimonial' => '<p>' . $faker->realText('150') .
            '</p><p>' . $faker->realText('100') . '</p>',
        'share' => $faker->randomElement( array(0,1)),
    ];
});
