<?php

use Faker\Generator as Faker;
$factory->define(App\Storage::class, function (Faker $faker) {
    $name_array = array('admin1','admin2','admin3');
    $location_array = array('ict','admin','canteen');
    return [
        'name' => array_random($name_array),
        'location' => array_random($location_array),
        'product_category' => mt_rand(1,5)
    ];
});
