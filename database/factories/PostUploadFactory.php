<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostUpload;
use Faker\Generator as Faker;

$factory->define(PostUpload::class, function (Faker $faker) {
    return [
        'post_id' => $faker->randomDigitNotNull,
        'hash' => $faker->sha1,
        'original' => ucfirst(implode('_', $faker->words(rand(2,5)))),
        'bytes' => $faker->randomNumber(8)
    ];
});
