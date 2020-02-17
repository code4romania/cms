<?php

namespace Code4Romania\Cms\Tests\Helpers;

use Code4Romania\Cms\Helpers\SettingsHelper;
use Code4Romania\Cms\Tests\TestCase;

class SettingsHelperTest extends TestCase
{
    /** @test */
    public function itSetsAndGetsValuesWithoutSection()
    {
        $settings = [
            'field' => $this->faker->word,
        ];

        SettingsHelper::set($settings);

        $this->assertEquals($settings['field'], SettingsHelper::get('field'));
        $this->assertNull(SettingsHelper::get('thisFieldDoesNotExist'));
    }

    /** @test */
    public function itSetsAndGetsValuesWithSection()
    {
        $settings = [
            'field' => $this->faker->word,
        ];

        $section = 'section';

        SettingsHelper::set($settings, $section);

        $this->assertEquals($settings['field'], SettingsHelper::get('field', $section));
        $this->assertNull(SettingsHelper::get('thisFieldDoesNotExist', $section));
    }
}
