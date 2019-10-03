<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {

    return [
        'name' => function () use ($faker) {
            $name = '';

            do {
                $name = $faker->unique()->word;
            } while (mb_strlen($name) < 6);

            return ucfirst($name);
        },
        'description' => $faker->sentences(rand(2,3), true)
    ];
});
