<?php

use Faker\Generator as Faker;

$factory->define(App\Requisition_Temp::class, function (Faker $faker) {
    return [
        'department' => $faker->name,
        'submittedBy' => $faker->name
    ];
});
