<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Code4Romania\Cms\Models\Page;
use Code4Romania\Cms\Models\Slugs\PageSlug;
use Code4Romania\Cms\Models\Translations\PageTranslation;
use Faker\Generator as Faker;

$factory->define(Page::class, static function (Faker $faker): array {
    return [
        'published'   => false,
        'position'    => 1,
        'show_header' => true,
    ];
});

$factory->state(Page::class, 'published', [
    'published' => true,
]);


$factory->define(PageTranslation::class, static function (Faker $faker): array {
    return [
        'page_id'     => null,
        'title'       => $faker->sentence,
        'description' => collect($faker->paragraphs)
            ->map(fn ($paragraph) => "<p>{$paragraph}</p>")
            ->join(''),
        'locale'      => 'en',
        'active'      => false,
    ];
});

$factory->state(PageTranslation::class, 'active', [
    'active' => true,
]);


$factory->define(PageSlug::class, static function (Faker $faker): array {
    return [
        'page_id' => null,
        'slug'    => $faker->slug,
        'locale'  => 'en',
        'active'  => false,
    ];
});

$factory->state(PageSlug::class, 'active', [
    'active' => true,
]);


$factory->afterCreating(Page::class, static function (Page $page, Faker $faker): void {
    $locales = collect(config('translatable.locales'));

    $page->slugs()->saveMany(
        $locales->map(function ($locale) use ($page) {
            return factory(PageSlug::class)
                ->state('active')
                ->create([
                    'page_id' => $page->id,
                    'locale'  => $locale,
                ]);
        })
    );

    $page->translation()->saveMany(
        $locales->map(function ($locale) use ($page) {
            return factory(PageTranslation::class)
                ->state('active')
                ->create([
                    'page_id' => $page->id,
                    'locale'  => $locale,
                ]);
        })
    );

    // we need to manually "reload" the collection built from the relationship
    // otherwise $this->translations()->get() would NOT be the same as $this->translations
    $page->load('translations');
});
