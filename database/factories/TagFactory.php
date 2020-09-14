<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Tag;

$factory->define(Tag::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
    ];
});
