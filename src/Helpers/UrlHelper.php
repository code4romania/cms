<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Helpers;

use A17\Twill\Models\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UrlHelper
{
    public static function isExternal($url): bool
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

    public static function getAlternateLocaleUrls(?Model $item = null): array
    {
        $routeName = Route::currentRouteName();
        $disabled = collect(config('translatable.disabled', []));

        return collect(config('translatable.locales', []))
            ->mapWithKeys(function (string $locale) use ($disabled, $routeName, $item): array {
                if ($disabled->contains($locale) || app()->getLocale() === $locale) {
                    return [];
                }

                if (is_null($item) || Str::endsWith($routeName, '.index')) {
                    return [
                        $locale => LaravelLocalization::getLocalizedURL($locale, route($routeName))
                    ];
                }

                if ($item->hasActiveTranslation($locale)) {
                    return [
                        $locale => LaravelLocalization::getLocalizedURL($locale, route($routeName, [
                            'slug' => $item->getSlug($locale),
                        ]))
                    ];
                }

                return [];
            })->toArray();
    }
}
