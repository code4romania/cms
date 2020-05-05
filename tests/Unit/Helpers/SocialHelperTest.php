<?php

declare(strict_types=1);

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
        $networks = collect(config('cms.social.networks'));

        SettingsHelper::set(
            $networks->map(fn (): string => $user)->toArray(),
            'social'
        );

        $this->assertSame(
            SocialHelper::getNetworks()->toArray(),
            $networks
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
