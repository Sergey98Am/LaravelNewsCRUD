<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PostTag;
use App\Models\Post;
use App\Models\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;





$factory->define(PostTag::class, function (Faker $faker) {
    return [
        'post_id' => Post::all()->random()->id,
        'tag_id' => Tag::all()->random()->id,
    ];
});
