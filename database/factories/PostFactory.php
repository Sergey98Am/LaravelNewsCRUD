<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'meta_title' => $faker->sentence(5),
        'meta_description' => $faker->sentence(10),
        'title' => $faker->sentence(2),
        'description' => $faker->text(),
        'image' =>  $faker->image('public/images',400,300, null, false),
        'category_id' => Category::all()->random()->id,
        'user_id' => User::all()->random()->id,
    ];
});

