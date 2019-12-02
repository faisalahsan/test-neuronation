<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\SessionExercise;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(SessionExercise::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 3),
        'score' => rand(0, 100),
        'session_id' => rand(1, 5),
        'category_id' => rand(1, 12),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
