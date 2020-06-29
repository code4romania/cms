<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Code4Romania\Cms\Models\Menu;
use Code4Romania\Cms\Models\Translations\MenuTranslation;
use Faker\Generator as Faker;

$factory->define(Menu::class, static function (Faker $faker): array {
    return [
        'published' => false,
        'location'  => null,
    ];
});


$factory->state(Menu::class, 'published', [
    'published' => true,
]);

$factory->state(Menu::class, 'header', [
    'location' => 'header',
]);

$factory->state(Menu::class, 'footer', [
    'location' => 'footer',
]);


$factory->state(MenuTranslation::class, 'active', [
    'active' => true,
]);

$factory->define(MenuTranslation::class, static function (Faker $faker): array {
    return [];
});

$factory->afterCreating(Menu::class, static function (Menu $menu, Faker $faker) {
    $locales = collect(config('translatable.locales'));

    $menu->translation()->saveMany(
        $locales->map(function ($locale) use ($menu) {
            return factory(MenuTranslation::class)
                ->state('active')
                ->create([
                    'menu_id' => $menu->id,
                    'locale'  => $locale,
                ]);
        })
    );

    // we need to manually "reload" the collection built from the relationship
    // otherwise $this->translations()->get() would NOT be the same as $this->translations
    $menu->load('translations');
});
