<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    return [
        'code' => strtoupper($faker->unique()->text(5)),
        'name' => $faker->unique()->name,
        'faculty_id'=>$faker->numberBetween(1, 5),
    ];
});
