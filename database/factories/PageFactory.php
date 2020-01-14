<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, static function (Faker $faker): array {
    return [
        'title' => $faker->title,
    ];
});
