<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Front;

use A17\Twill\Http\Controllers\Front\Controller as TwillFrontControler;
use A17\Twill\Repositories\SettingRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Controller extends TwillFrontControler
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getStoredValue(string $key, ?string $section = null): string
    {
        return app(SettingRepository::class)->byKey($key, $section);
    }

    public function getAlternateLocaleUrls(string $routeName, $item = null): array
    {
        $alternateUrls = [];

        foreach (config('translatable.locales', []) as $locale) {
            if (in_array($locale, config('translatable.disabled'))) {
                continue;
            }

            if (app()->getLocale() === $locale) {
                continue;
            }

            if (is_null($item)) {
                $alternateUrls[$locale] = LaravelLocalization::getLocalizedURL($locale, route($routeName));
            } elseif ($item->hasActiveTranslation($locale)) {
                $alternateUrls[$locale] = LaravelLocalization::getLocalizedURL($locale, route($routeName, [
                    'slug' => $item->getSlug($locale),
                ]));
            }
        }

        return $alternateUrls;
    }

    public function isPreview()
    {
        return Str::endsWith(Route::currentRouteName(), '.preview');
    }
}
