<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Features;
use Faker\Generator as Faker;

$factory->define(Features::class, function (Faker $faker) {
    $status = ['planned', 'requested', 'completed'];
    return [
        'title' => $faker->sentence(5),
        'status' => $faker->randomElement(['planned', 'requested', 'completed'])
    ];
});
