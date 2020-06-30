<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Helpers;

use A17\Twill\Models\Model;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UrlHelper
{
    public static function isExternal(string $url): bool
    {
        $parts = parse_url($url);

        if (!isset($parts['scheme'])) {
            return false;
        }

        if (Str::contains(config('app.url'), $parts['host'])) {
            return false;
        }

        return true;
    }

    public static function isAdminUrl(?string $url = null): bool
    {
        $currentUrl = $url ?? request()->url();
        $adminUrl   = route('admin.dashboard');

        return Str::startsWith($currentUrl, $adminUrl);
    }

    public static function getAlternateLocaleUrls(?string $routeName, ?Model $item = null): array
    {
        if ($routeName === null) {
            return [];
        }

        return collect(config('translatable.locales', []))
            ->diff(config('translatable.disabled', []))
            ->reject(fn (string $locale) => app()->getLocale() === $locale || Str::endsWith($routeName, '.preview'))
            ->mapWithKeys(function (string $locale) use ($routeName, $item): array {
                if (Str::endsWith($routeName, '.index')) {
                    return [
                        $locale => LaravelLocalization::getLocalizedURL($locale, route($routeName))
                    ];
                }

                if (is_null($item)) {
                    return [];
                }

                if ($item->hasActiveTranslation($locale)) {
                    return [
                        $locale => LaravelLocalization::getLocalizedURL($locale, route($routeName, [
                            'slug' => $item->getSlug($locale),
                        ]))
                    ];
                }

                return [];
            })
            ->toArray();
    }
}
