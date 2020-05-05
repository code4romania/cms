<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Code4Romania\Cms\Models\CityLab;
use Code4Romania\Cms\Models\Slugs\CityLabSlug;
use Code4Romania\Cms\Models\Translations\CityLabTranslation;
use Faker\Generator as Faker;

$factory->define(CityLab::class, function (Faker $faker) {
    return [
        'published'   => false,
    ];
});

$factory->state(CityLab::class, 'published', [
    'published' => true,
]);


$factory->define(CityLabTranslation::class, static function (Faker $faker): array {
    return [
        'locale'      => 'en',
        'active'      => false,
        'city_lab_id' => null,
        'name'        => $faker->city,
        'description' => collect($faker->paragraphs)
            ->map(fn ($paragraph) => "<p>{$paragraph}</p>")
            ->join(''),
    ];
});

$factory->state(CityLabTranslation::class, 'active', [
    'active' => true,
]);


$factory->define(CityLabSlug::class, static function (Faker $faker): array {
    return [
        'locale'      => 'en',
        'active'      => false,
        'city_lab_id' => null,
        'slug'        => $faker->slug,
    ];
});

$factory->state(CityLabSlug::class, 'active', [
    'active' => true,
]);




$factory->afterCreating(CityLab::class, static function (CityLab $cityLab, Faker $faker): void {
    $locales = collect(config('translatable.locales'));

    $cityLab->slugs()->saveMany(
        $locales->map(function ($locale) use ($cityLab) {
            return factory(CityLabSlug::class)
                ->state('active')
                ->create([
                    'city_lab_id' => $cityLab->id,
                    'locale'      => $locale,
                ]);
        })
    );

    $cityLab->translation()->saveMany(
        $locales->map(function ($locale) use ($cityLab) {
            return factory(CityLabTranslation::class)
                ->state('active')
                ->create([
                    'city_lab_id' => $cityLab->id,
                    'locale'      => $locale,
                ]);
        })
    );

    // we need to manually "reload" the collection built from the relationship
    // otherwise $this->translations()->get() would NOT be the same as $this->translations
    $cityLab->load('translations');
});
