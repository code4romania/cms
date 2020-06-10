<?php

namespace Code4Romania\Cms\Tests\Presenters;

use A17\Twill\Models\Block;
use Code4Romania\Cms\Models\Form;
use Code4Romania\Cms\Tests\TestCase;
use Illuminate\Support\Collection;

class FormPresenterTest extends TestCase
{
    protected function createFormFields(Block $section): Collection
    {
        return collect(config('cms.form.fields'))
            ->each(function (string $type) use ($section) {
                $content = [
                    'type'     => $type,
                    'label'    => $this->faker->word,
                    'help'     => $this->faker->sentence,
                    'required' => $this->faker->boolean,
                ];

                switch ($type) {
                    case 'text':
                    case 'textarea':
                        $content['maxLength'] = $this->faker->optional()->randomDigit;
                        break;

                    case 'number':
                        $content['minValue'] = $this->faker->optional()->randomDigit;
                        $content['maxValue'] = $this->faker->optional()->randomDigit;
                        break;

                    case 'date':
                        $maxDate = $this->faker->optional()->date;
                        $content['minDate'] = $this->faker->optional()->date('Y-m-d', $maxDate ?? 'now');
                        $content['maxDate'] = $maxDate;
                        break;

                    case 'checkbox':
                        $content['checkboxLabel'] = $this->faker->word;
                        break;
                }

                $section->children()->create(
                    factory(Block::class)
                        ->make([
                            'blockable_id'   => $section->blockable_id,
                            'blockable_type' => $section->blockable_type,
                            'type'           => 'formField',
                            'content'        => $content,
                        ])
                        ->toArray()
                );
            });
    }

    /** @test */
    public function it_generates_the_form_fields()
    {
        $form = factory(Form::class)
            ->state('published')
            ->create();

        $form->blocks()->createMany(
            factory(Block::class, 2)
                ->make([
                    'blockable_id'   => $form->id,
                    'blockable_type' => 'form',
                    'type'           => 'formSection',
                    'content'        => [
                        'name'        => $this->faker->word,
                        'description' => $this->faker->paragraph,
                    ],
                ])
                ->toArray()
        );

        $form->blocks->each(function ($section) {
            return $this->createFormFields($section);
        });
    }
}
