<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Code4Romania\Cms\Models\Category;
use Code4Romania\Cms\Models\Slugs\CategorySlug;
use Code4Romania\Cms\Models\Translations\CategoryTranslation;
use Faker\Generator as Faker;

$factory->define(Category::class, static function (Faker $faker): array {
    return [];
});

$factory->define(CategoryTranslation::class, static function (Faker $faker): array {
    return [
        'category_id' => null,
        'title'       => $faker->sentence,
        'description' => collect($faker->paragraphs)
            ->map(fn ($paragraph) => "<p>{$paragraph}</p>")
            ->join(''),
        'locale'      => 'en',
        'active'      => false,
    ];
});

$factory->state(CategoryTranslation::class, 'active', [
    'active' => true,
]);


$factory->define(CategorySlug::class, static function (Faker $faker): array {
    return [
        'category_id' => null,
        'slug'        => $faker->slug,
        'locale'      => 'en',
        'active'      => false,
    ];
});

$factory->state(CategorySlug::class, 'active', [
    'active' => true,
]);


$factory->afterCreating(Category::class, static function (Category $category, Faker $faker): void {
    $locales = collect(config('translatable.locales'));

    $category->slugs()->saveMany(
        $locales->map(function ($locale) use ($category) {
            return factory(CategorySlug::class)
                ->state('active')
                ->create([
                    'category_id' => $category->id,
                    'locale'      => $locale,
                ]);
        })
    );

    $category->translation()->saveMany(
        $locales->map(function ($locale) use ($category) {
            return factory(CategoryTranslation::class)
                ->state('active')
                ->create([
                    'category_id' => $category->id,
                    'locale'      => $locale,
                ]);
        })
    );

    // we need to manually "reload" the collection built from the relationship
    // otherwise $this->translations()->get() would NOT be the same as $this->translations
    $category->load('translations');
});
