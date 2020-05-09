<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use A17\Twill\Models\Media;
use Faker\Generator as Faker;

$factory->define(Media::class, static function (Faker $faker): array {
    $uuid = $faker->uuid;
    $width = $faker->numberBetween(500, 1000);
    $height = $faker->numberBetween(500, 1000);
    $filename = $faker->image(storage_path("app/public/uploads/{$uuid}"), $width, $height, false);

    return [
        'uuid'     => $uuid . '/' . $filename,
        'filename' => $filename,
        'width'    => $width,
        'height'   => $height,
        'alt_text' => $faker->sentence,
        'caption'  => null,
    ];
});
