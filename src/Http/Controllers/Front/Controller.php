<?php

namespace Code4Romania\Cms\Http\Controllers\Front;

use A17\Twill\Http\Controllers\Front\Controller as TwillFrontControler;
use A17\Twill\Repositories\SettingRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Localization;

class Controller extends TwillFrontControler
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $key
     * @param string|null $section
     * @return string
     */
    public function getStoredValue(string $key, string $section = null): string
    {
        return app(SettingRepository::class)->byKey($key, $section);
    }

    /**
     * @param string $routeName
     * @param string|null $item
     * @return array
     */
    // public function getAlternateLocaleUrls(string $routeName, string $item = null): array
    // {
    //     $alternateUrls = [];

    //     foreach (config('translatable.locales') as $locale) {
    //         if (in_array($locale, config('translatable.disabled'))) {
    //             continue;
    //         }

    //         if (app()->getLocale() === $locale) {
    //             continue;
    //         }

    //         if (!is_null($item)) {
    //             if ($item->hasActiveTranslation($locale)) {
    //                 $alternateUrls[$locale] = Localization::getLocalizedURL($locale, route($routeName, [
    //                     'slug' => $item->getSlug($locale),
    //                 ]));
    //             }
    //         } else {
    //             $alternateUrls[$locale] = Localization::getLocalizedURL($locale, route($routeName));
    //         }
    //     }

    //     return $alternateUrls;
    // }
}
