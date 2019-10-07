<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostUpload;
use Faker\Generator as Faker;

$factory->define(PostUpload::class, function (Faker $faker) {

    $sha1 = $faker->sha1;
    $fileExtension = $faker->fileExtension;
    $fileOriginal = ucfirst(implode('_', $faker->words(rand(2,5))));

    return [
        'post_id' => $faker->randomDigitNotNull,
        'path' => sprintf("%s/%s.%s", config('app.uploads_dir_name'), $sha1, $fileExtension),
        'name_original' => sprintf("%s.%s", $fileOriginal, $fileExtension),
        'name_hash' => $sha1,
        'extension' => $fileExtension,
        'bytes' => $faker->randomNumber(8),
    ];
});

/**
 * State with predefined values, which are used
 * for all the posts, generated by the factory
 * during seeding application with seeder.
 * 
 * This is necessary for the option "Download Files"
 * to work correctly.
 * 
 */
$factory->state(PostUpload::class, 'predefined', [
    'path' => sprintf("%s/%s", config('app.uploads_dir_name'), "GwBykyuFqduXs8ObHzAj30Z3Y0mZdnBgeZxlYXzS.pdf"),
    'name_original' => 'Mazda.pdf',
    'name_hash' => 'GwBykyuFqduXs8ObHzAj30Z3Y0mZdnBgeZxlYXzS',
    'extension' => 'pdf',
    'bytes' => '4488478',
]);
