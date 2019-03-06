<?php

use Faker\Generator as Faker;

$factory->define(App\Model\TurfFacility::class, function (Faker $faker) {
    $facilities = ['Changing Room' => 2, 'Flood Lights' => 2, 'Seating Area' => 1, 'Rent Footwears' => 5, 'Rent Jerseys' => 5, 'Free water' => 2, 'Free Balls' => 1];
    return [
        "facility" => collect($facilities)->keys()->random(1)->first(),
        "turf_id" => \App\Model\Turf::all()->random(1)->first()->id,
        "value" => random_int(1,5)
    ];
});
