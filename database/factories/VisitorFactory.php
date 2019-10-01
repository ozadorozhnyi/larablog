<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Visitor;
use Faker\Generator as Faker;
use Jenssegers\Agent\Agent as UserAgent;

$agent = new UserAgent();

$factory->define(Visitor::class, function (Faker $faker) use ($agent)
{
    $raw = $faker->userAgent;

    $agent->setUserAgent($raw);

    $browser = $agent->browser();

    return [
        'raw' => $raw,
        'browser' => $browser,
        // remove minor version updates
        'version' => substr($agent->version($browser), 0, 4),
        'device' => $agent->device(),
        'platform' => $agent->platform()
    ];
});
