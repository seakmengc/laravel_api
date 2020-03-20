<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Faculty;
use Faker\Generator as Faker;

$factory->define(Faculty::class, function (Faker $faker) {
    return [
        'code' => strtoupper($faker->unique()->text(5)),
        'name' => $faker->unique()->name,
    ];
});
