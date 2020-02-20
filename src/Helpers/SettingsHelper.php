<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Helpers;

use A17\Twill\Repositories\SettingRepository;

class SettingsHelper
{
    public static function get(string $key, ?string $section = null): ?string
    {
        return app(SettingRepository::class)
            ->byKey($key, $section);
    }

    public static function set($fields, ?string $section = null): void
    {
        app(SettingRepository::class)
            ->saveAll($fields, $section);
    }
}
