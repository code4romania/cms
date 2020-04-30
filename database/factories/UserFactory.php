<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use A17\Twill\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, static function (Faker $faker): array {
    return [
        'published'   => false,
        'name'        => $faker->name,
        'email'       => $faker->safeEmail,
        'password'    => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'role'        => 'VIEWONLY',
    ];
});

$factory->state(User::class, 'active', [
    'published' => true,
]);

$factory->state(User::class, 'admin', [
    'role' => 'ADMIN',
]);

$factory->state(User::class, 'publisher', [
    'role' => 'PUBLISHER',
]);
