<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests\Helpers;

use Code4Romania\Cms\Helpers\SettingsHelper;
use Code4Romania\Cms\Tests\TestCase;

class SettingsHelperTest extends TestCase
{
    /** @test */
    public function itSetsAndGetsValuesWithoutSection()
    {
        $field = $this->faker->word;
        $settings = [
            $field => $this->faker->word,
        ];

        SettingsHelper::set($settings);

        $this->assertEquals($settings[$field], SettingsHelper::get($field));
        $this->assertNull(SettingsHelper::get('thisFieldDoesNotExist'));
    }

    /** @test */
    public function itSetsAndGetsValuesWithSection()
    {
        $field = $this->faker->word;
        $section = $this->faker->word;

        $settings = [
            $field => $this->faker->word,
        ];


        SettingsHelper::set($settings, $section);

        $this->assertEquals($settings[$field], SettingsHelper::get($field, $section));
        $this->assertNull(SettingsHelper::get('thisFieldDoesNotExist', $section));
    }

    /** @test */
    public function itGetsValueForSection()
    {
        $field = $this->faker->word;
        $section = $this->faker->word;

        $settings = [
            $field => $this->faker->word,
        ];

        SettingsHelper::set($settings, $section);

        $this->assertEquals($settings, SettingsHelper::getSection($section));
    }
}
