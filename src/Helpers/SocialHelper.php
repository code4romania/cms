<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Helpers;

use Illuminate\Support\Collection;

class SocialHelper
{
    /**
     * Retrieve social media profile settings, filter and format for footer display
     */
    public static function getNetworks(): Collection
    {
        $settings = SettingsHelper::getSection('social');

        return collect(config('cms.social.networks', []))
            ->map(function ($value, $key) use ($settings): ?string {
                $username = $settings[$key] ?? null;

                if ($username === null) {
                    return null;
                }

                return $value['baseUrl'] . $username;
            })
            ->filter();
    }
}
