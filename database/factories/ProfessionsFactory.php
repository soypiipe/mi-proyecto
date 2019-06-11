<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Professions;
use Faker\Generator as Faker;

$factory->define(Professions::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle
    ];
});
