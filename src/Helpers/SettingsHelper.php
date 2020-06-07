<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Helpers;

use A17\Twill\Models\Setting;
use A17\Twill\Repositories\SettingRepository;
use Illuminate\Support\Facades\Cache;

class SettingsHelper
{
    public static function get(string $key, string $section): ?string
    {
        return static::getSection($section)[$key] ?? null;
    }

    public static function set(array $fields, ?string $section = null): void
    {
        app(SettingRepository::class)
            ->saveAll($fields, $section);
    }

    public static function getSection(string $section): array
    {
        return Cache::rememberForever('settings.' . $section, function () use ($section) {
            return Setting::query()
                ->where('section', $section)
                ->with('translations')
                ->get()
                ->mapWithKeys(fn ($item) => [$item->key => $item->value])
                ->toArray();
        });
    }
}
