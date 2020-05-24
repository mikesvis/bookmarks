<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Bookmark;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Bookmark::class, function (Faker $faker) {

    return [
        'url' => $faker->url,
        'title' => $faker->sentence($nbWords = 5),
        'description' => $faker->sentence,
        'keywords' => $faker->words($nb = 5, $asText = true),
        'favicon' => null,
        'password' => (bool)rand(0, 1) ? null : Hash::make('password'), // password,
    ];
});
