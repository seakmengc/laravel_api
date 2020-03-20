<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $year = (int) $faker->year;

    return [
        'academic' => $year . '-' . ($year + 1),
        'semester' => $faker->numberBetween(1, 8),
        'code' => strtoupper($faker->unique()->text(5)),
        'name' => $faker->unique()->text(10),
        'description' => $faker->unique()->realText(30),
        'department_id' => $faker->numberBetween(1, 5),
        'taught_by' => null,
    ];
});
