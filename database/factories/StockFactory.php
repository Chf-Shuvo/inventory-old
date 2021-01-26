<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Stock::class, function (Faker $faker) {
    $location_array = array('ict','admin','canteen');
    return [
        'category' => mt_rand(1,5),
        'product' => mt_rand(1,50),
        'vendor' =>  mt_rand(1,50),
        'quantity' => mt_rand(1,100),
        'price' => mt_rand(1,100),
        'date' => "12 Sep 2019",
        'storage' => mt_rand(1,10),
        'note' => Str::random(100)
    ];
});
