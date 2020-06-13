<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Helpers;

use A17\Twill\Models\Block;
use Code4Romania\Cms\Models\Form;
use Code4Romania\Cms\Tests\TestCase;
use Illuminate\Support\Collection;

class HasFormFieldsTest extends TestCase
{
    protected function localizedStrings(string $type): Collection
    {
        return $this
            ->getAvailableLocales()
            ->mapWithKeys(fn ($locale) => [$locale => $this->faker->$type]);
    }

    protected function field(array $data): array
    {
        return array_merge([
            'label'     => $this->localizedStrings('sentence'),
            'help'      => $this->localizedStrings('paragraph'),
        ], $data);
    }

    protected function fields(): Collection
    {
        return collect([
            $this->field([
                'type'      => 'text',
                'required'  => true,
                'minLength' => null,
                'maxLength' => $this->faker->randomDigitNotNull,
            ]),
            $this->field([
                'type'      => 'text',
                'required'  => true,
                'minLength' => null,
                'maxLength' => $this->faker->randomDigitNotNull,
            ]),
            $this->field([
                'type'      => 'text',
                'required'  => false,
                'minLength' => $this->faker->randomDigitNotNull,
                'maxLength' => null,
            ]),
            $this->field([
                'type'      => 'textarea',
                'required'  => true,
                'minLength' => null,
                'maxLength' => null,
            ]),
            $this->field([
                'type'      => 'textarea',
                'required'  => false,
                'minLength' => $this->faker->numberBetween(20, 30),
                'maxLength' => $this->faker->numberBetween(40, 50),
            ]),
            $this->field([
                'type'      => 'email',
                'required'  => true,
            ]),
            $this->field([
                'type'      => 'email',
                'required'  => false,
            ]),
            $this->field([
                'type'      => 'url',
                'required'  => true,
            ]),
            $this->field([
                'type'      => 'url',
                'required'  => false,
            ]),
            $this->field([
                'type'     => 'number',
                'required' => true,
                'minValue' => null,
                'maxValue' => null,
            ]),
            $this->field([
                'type'     => 'number',
                'required' => false,
                'minValue' => $this->faker->numberBetween(100, 120),
                'maxValue' => null,
            ]),
            $this->field([
                'type'     => 'number',
                'required' => true,
                'minValue' => null,
                'maxValue' => $this->faker->numberBetween(210, 230),
            ]),
            $this->field([
                'type'     => 'number',
                'required' => false,
                'minValue' => $this->faker->numberBetween(100, 120),
                'maxValue' => $this->faker->numberBetween(210, 230),
            ]),
            $this->field([
                'type'     => 'date',
                'required' => true,
                'minDate'  => null,
                'maxDate'  => null,
            ]),
            $this->field([
                'type'     => 'date',
                'required' => false,
                'minDate'  => null,
                'maxDate'  => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
            ]),
            $this->field([
                'type'     => 'date',
                'required' => true,
                'minDate'  => $this->faker->dateTimeBetween('now', '10 years')->format('Y-m-d'),
                'maxDate'  => null,
            ]),
            $this->field([
                'type'     => 'date',
                'required' => false,
                'minDate'  => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
                'maxDate'  => $this->faker->dateTimeBetween('now', '10 years')->format('Y-m-d'),
            ]),
            $this->field([
                'type'          => 'checkbox',
                'required'      => true,
                'checkboxLabel' => $this->localizedStrings('sentence'),
            ]),
            $this->field([
                'type'          => 'checkbox',
                'required'      => false,
                'checkboxLabel' => $this->localizedStrings('sentence'),
            ]),
        ]);
    }

    protected function createFormWithSectionsAndFields(int $sections, Collection $fields): Form
    {
        $form = factory(Form::class)
            ->state('published')
            ->create();

        $form->blocks()->createMany(
            factory(Block::class, $sections)
                ->make([
                    'blockable_id'   => $form->id,
                    'blockable_type' => 'form',
                    'type'           => 'formSection',
                    'content'        => [
                        'name'        => $this->localizedStrings('sentence'),
                        'description' => $this->localizedStrings('paragraph'),
                    ],
                ])
                ->toArray()
        );

        $form->blocks->each(function ($section) use ($fields) {
            return $fields
                ->each(function (array $field, int $position) use ($section) {
                    $section->children()->create(
                        factory(Block::class)
                            ->make([
                                'blockable_id'   => $section->blockable_id,
                                'blockable_type' => $section->blockable_type,
                                'position'       => $position,
                                'type'           => 'formField',
                                'content'        => $field,
                            ])
                            ->toArray()
                    );
                });
        });

        $form->load('blocks');

        return $form;
    }

    /** @test */
    public function it_generates_the_form_fields()
    {
        $sections = 2;
        $fields = $this->fields();

        $form = $this->createFormWithSectionsAndFields($sections, $fields);

        $this->assertCount($sections, $form->getSections());
        $this->assertCount($sections * $fields->count(), $form->getFieldsBySection()->pluck('fields')->flatten(1));

        $form->getFields($form->getSections()->first())['fields']
            ->each(function ($field, $index) use ($fields) {
                $expected = $fields[$index];

                $this->assertEquals($expected['type'], $field['type']);
                $this->assertEquals($expected['required'], $field['required']);

                if (array_key_exists('minLength', $expected)) {
                    $this->assertEquals($expected['minLength'], $field['minLength']);
                }

                if (array_key_exists('maxLength', $expected)) {
                    $this->assertEquals($expected['maxLength'], $field['maxLength']);
                }

                if (array_key_exists('minValue', $expected)) {
                    $this->assertEquals($expected['minValue'], $field['minValue']);
                }

                if (array_key_exists('maxValue', $expected)) {
                    $this->assertEquals($expected['maxValue'], $field['maxValue']);
                }

                if (array_key_exists('minDate', $expected)) {
                    $this->assertEquals($expected['minDate'], $field['minDate']);
                }

                if (array_key_exists('maxDate', $expected)) {
                    $this->assertEquals($expected['maxDate'], $field['maxDate']);
                }
            });
    }
}
