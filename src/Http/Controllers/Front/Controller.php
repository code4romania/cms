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

    /**
     * Fetch
     *
     * @param string $key
     * @param string|null $section
     * @return string
     */
    public function getStoredValue(string $key, ?string $section = null): string
    {
        return app(SettingRepository::class)->byKey($key, $section);
    }

    /**
     *
     * @param string $routeName
     * @param mixed $item
     * @return array
     */
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


            if (!is_null($item) && $item->hasActiveTranslation($locale)) {
                $alternateUrls[$locale] = LaravelLocalization::getLocalizedURL($locale, route($routeName, [
                    'slug' => $item->getSlug($locale),
                ]));
            } else {
                $alternateUrls[$locale] = LaravelLocalization::getLocalizedURL($locale, route($routeName));
            }
        }

        return $alternateUrls;
    }

    public function isPreview()
    {
        /**
         * @var string
         */
        $routeName = Route::currentRouteName();

        return Str::endsWith($routeName, '.preview');
    }
}
