<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LastLogin;
use Faker\Generator as Faker;

$factory->define(LastLogin::class, function (Faker $faker) {
    return [
        'logged_at' => $faker->dateTimeBetween('-80 years', '-20 years'),
    ];
});
