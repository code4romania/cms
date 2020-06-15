<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Code4Romania\Cms\Models\Form;
use Code4Romania\Cms\Models\Response;
use Faker\Generator as Faker;

$factory->define(Response::class, static function (Faker $faker): array {
    return [
        'form_id' => factory(Form::class),
        'data'    => collect(range(0, $faker->randomDigitNotNull))
            ->map(function () use ($faker) {
                return [
                    'title'  => $faker->sentence,
                    'fields' => collect(range(0, $faker->randomDigitNotNull))
                        ->map(function () use ($faker) {
                            return [
                                'label' => $faker->sentence,
                                'value' => $faker->word,
                            ];
                        }),
                ];
            }),
    ];
});
