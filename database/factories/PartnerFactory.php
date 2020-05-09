<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Code4Romania\Cms\Models\Partner;
use Faker\Generator as Faker;

$factory->define(Partner::class, static function (Faker $faker): array {
    return [
        'published' => false,
        'name'      => $faker->name,
        'website'   => $faker->boolean(75) ? 'https://' . $faker->safeEmailDomain : null,
    ];
});


$factory->state(Partner::class, 'published', [
    'published' => true,
]);
