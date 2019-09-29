<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'category_id' => $faker->randomDigitNotNull,
        'name' => $faker->sentence(),
        'content' => $faker->realText(rand(4500, 8000), 5) 
    ];
});
