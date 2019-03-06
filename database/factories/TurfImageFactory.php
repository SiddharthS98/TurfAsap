<?php

use Faker\Generator as Faker;

$factory->define(App\Model\TurfImage::class, function (Faker $faker) {
    return [
        'image_path' => $faker->imageUrl(640,480,'sports'),
        'turf_id' => \App\Model\Turf::all()->random(1)->first()->id
    ];
});
