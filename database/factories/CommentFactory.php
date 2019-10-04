<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'commentable_id' => $faker->randomDigitNotNull,
        'commentable_type' => 'App\Category', // assign to the category by default
        'author' => implode(" ", [$faker->firstNameMale, $faker->firstNameFemale]),
        'content' => $faker->paragraphs(rand(1, 5), true)
    ];
});

$factory->state(Comment::class, 'category', [
    'commentable_type' => 'App\Category',
]);

$factory->state(Comment::class, 'post', [
    'commentable_type' => 'App\Post',
]);