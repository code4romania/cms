<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Code4Romania\Cms\Models\Form;
use Code4Romania\Cms\Models\Translations\FormTranslation;
use Faker\Generator as Faker;

$factory->define(Form::class, static function (Faker $faker): array {
    return [
        'published'   => false,
        'store'       => false,
        'send'        => false,
        'confirm'     => false,
        'recipients'  => null,
    ];
});

$factory->state(Form::class, 'published', [
    'published' => true,
]);

$factory->define(FormTranslation::class, static function (Faker $faker): array {
    return [
        'form_id'     => null,
        'title'       => $faker->sentence,
        'locale'      => 'en',
        'active'      => false,
    ];
});

$factory->state(FormTranslation::class, 'active', [
    'active' => true,
]);

$factory->afterCreating(Form::class, static function (Form $form, Faker $faker): void {
    $locales = collect(config('translatable.locales'));

    $form->translation()->saveMany(
        $locales->map(function ($locale) use ($form) {
            return factory(FormTranslation::class)
                ->state('active')
                ->create([
                    'form_id' => $form->id,
                    'locale'  => $locale,
                ]);
        })
    );

    // we need to manually "reload" the collection built from the relationship
    // otherwise $this->translations()->get() would NOT be the same as $this->translations
    $form->load('translations');
});
