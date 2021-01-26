<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category' => mt_rand(1,5),
        'brand' => Str::random(11),
        'code' => 'BP-'.mt_rand(1000,9999)
    ];
});
