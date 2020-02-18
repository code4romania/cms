<?php

namespace Code4Romania\Cms\Tests\Helpers;

use Code4Romania\Cms\Helpers\SettingsHelper;
use Code4Romania\Cms\Helpers\SocialHelper;
use Code4Romania\Cms\Tests\TestCase;

class SocialHelperTest extends TestCase
{

    /** @test */
    public function itFetchesFormattedNetworks()
    {
        $user = $this->faker->userName;
        $socialNetworks = collect(config('cms.socialNetworks'));

        SettingsHelper::set(
            $socialNetworks->map(fn (): string => $user),
            'social'
        );

        $this->assertSame(
            SocialHelper::getNetworks()->toArray(),
            $socialNetworks
                ->map(fn ($network) => $network['baseUrl'] . $user)
                ->toArray()
        );
    }

    /** @test */
    public function itSkipsUnconfiguredNetworks()
    {
        $this->assertEmpty(SocialHelper::getNetworks()->toArray());
    }
}
