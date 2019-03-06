<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Turf::class, function (Faker $faker) {
//    $facilities = ['Changing Room', 'Flood Lights', 'Seating Area', 'Rent Footwears', 'Rent Jerseys', 'Free water', 'Free Balls'];

    return [
        'name' => $faker->streetName,
        'price' => collect([500, 1000, 1500, 2000, 2500])->random(1)->first(),
        'from' => 7,
        'to' => 23,
        "user_id" => 2,
        'address' => $faker->address,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'type' => collect(['football', 'cricket', 'baseball', 'basketball', 'hockey', 'any'])->random(1)->first(),
        'length' => $faker->randomNumber(2),
        'width' => $faker->randomNumber(2),
        'capacity' => collect([8,10,12])->random(1)->first(),
        'footwear' => collect(['studs', 'flats', 'any'])->random(1)->first()
    ];
});

$factory->afterCreating(App\Model\Turf::class, function ($turf, $faker) {
    $facilities = ['Changing Room', 'Flood Lights', 'Seating Area', 'Rent Footwears', 'Rent Jerseys', 'Free water', 'Free Balls'];

    for ($i = 0; $i < 3; $i++) {
        $index = random_int(0, count($facilities)-1);
        $facility = $facilities[$index];
        factory(App\Model\TurfFacility::class)->create([
            'facility' => $facility,
            'turf_id' => $turf->id
        ]);

        unset($facilities[$index]);
        $facilities = array_values($facilities);
    }
});

$factory->afterCreating(App\Model\Turf::class, function ($turf, $faker) {

    for ($i = 0; $i < 3; $i++) {
        factory(App\Model\TurfImage::class)->create([
            'turf_id' => $turf->id
        ]);

    }
});
