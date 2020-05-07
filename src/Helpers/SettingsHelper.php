<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Helpers;

use A17\Twill\Models\Setting;
use A17\Twill\Repositories\SettingRepository;

class SettingsHelper
{
    public static function get(string $key, ?string $section = null): ?string
    {
        return app(SettingRepository::class)
            ->byKey($key, $section);
    }

    public static function set(array $fields, ?string $section = null): void
    {
        app(SettingRepository::class)
            ->saveAll($fields, $section);
    }

    public static function getSection(string $section): array
    {
        return Setting::where('section', $section)
            ->with(['translations'])
            ->get()
            ->mapWithKeys(fn ($item) => [$item->key => $item->value])
            ->toArray();
    }
}
