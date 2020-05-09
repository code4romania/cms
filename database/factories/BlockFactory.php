<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use A17\Twill\Models\Block;
use Faker\Generator as Faker;

$factory->define(Block::class, static function (Faker $faker): array {
    return [
        'type'     => null,
        'position' => $faker->randomDigitNotNull,
        'content'  => [],
    ];
});
