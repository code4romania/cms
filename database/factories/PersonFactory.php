<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Code4Romania\Cms\Models\Person;
use Code4Romania\Cms\Models\Translations\PersonTranslation;
use Faker\Generator as Faker;

$factory->define(Person::class, static function (Faker $faker): array {
    return [
        'published' => false,
        'name'      => $faker->name,
    ];
});


$factory->state(Person::class, 'published', [
    'published' => true,
]);


$factory->state(PersonTranslation::class, 'active', [
    'active' => true,
]);

$factory->define(PersonTranslation::class, static function (Faker $faker): array {
    return [];
});

$factory->afterCreating(Person::class, static function (Person $person, Faker $faker) {
    $locales = collect(config('translatable.locales'));

    $person->translation()->saveMany(
        $locales->map(function ($locale) use ($person) {
            return factory(PersonTranslation::class)
                ->state('active')
                ->create([
                    'person_id' => $person->id,
                    'locale'    => $locale,
                ]);
        })
    );

    // we need to manually "reload" the collection built from the relationship
    // otherwise $this->translations()->get() would NOT be the same as $this->translations
    $person->load('translations');
});
