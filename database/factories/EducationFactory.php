<?php

use Faker\Generator as Faker;

$factory->define(App\Education::class, function (Faker $faker) {
    $state = $faker->state;
    $year = $faker->numberBetween($min = 1990, $max = 2013);
    return [
        'type' => $faker
            ->randomElement( array('High School', 'Trade School', 'Technical School', 'College')),
        'diploma' => $faker
            ->randomElement( array('GED', 'High School Diploma', 'Certification', 'Associate\'s Degree
                ', 'Bachelor\'s Degree', 'Post Graduate Degree')),
        'school' => $faker
            ->randomElement(array($state . ' State University', 'University of ' . $state)),
        'location' => $faker->city . ', ' . $state,
        'start_year' => $year,
        'end_year' => $year + 4,
        'testimonial' => '<p>' . $faker->realText('150') .
            '</p><p>' . $faker->realText('100') . '</p>',
        'share' => $faker->randomElement( array(0,1)),
    ];
});
