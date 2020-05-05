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
        return collect(config('cms.social.networks', []))
            ->map(function ($value, $key): ?string {
                $username = SettingsHelper::get($key, 'social');

                if (is_null($username)) {
                    return null;
                }

                return $value['baseUrl'] . $username;
            })
            ->filter();
    }
}
