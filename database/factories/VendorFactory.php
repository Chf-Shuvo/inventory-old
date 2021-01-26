<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Vendor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'contact_person' => $faker->name,
        'contact_person_phone' => Str::random(11),
        'phone' => Str::random(11),
        'address' => Str::random(11)
    ];
});
