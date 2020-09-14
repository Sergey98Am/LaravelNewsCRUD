<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'comment' => $faker->sentence(10),
        'post_id' => Post::all()->random()->id,
        'user_id' => $faker->boolean() ? User::all()->random()->id : null,
    ];
});
