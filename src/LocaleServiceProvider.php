<?php

declare(strict_types=1);

namespace Code4Romania\Cms;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;

class LocaleServiceProvider extends ServiceProvider
{
    /**
     * Bootstraps the package services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerRouteMiddlewares();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->setupLocalizationConfig();
    }

    /**
     * Infers laravellocalization config from translatable
     *
     * @return void
     */
    public function setupLocalizationConfig(): void
    {
        $config = [
            'useAcceptLanguageHeader' => config('translatable.useAcceptLanguageHeader', false),
            'hideDefaultLocaleInURL' => false,
            'supportedLocales' => [],
            'localesOrder' => config('translatable.locales'),
        ];

        $languages = config('translatable.languages', []);

        foreach ($languages as $locale => $name) {
            if (in_array($locale, config('translatable.disabled'))) {
                continue;
            }

            $config['supportedLocales'][$locale] = [
                'script' => 'Latn',
                'native' => $name,
                'name'   => $name,
            ];

            $config['localesMapping'] = [];
        }

        config([
            'laravellocalization' => $config,
        ]);
    }

    /**
     * Register Route middleware.
     *
     * @return void
     */
    private function registerRouteMiddlewares(): void
    {
        Route::aliasMiddleware('localeRedirectFilter', LaravelLocalizationRedirectFilter::class);
        Route::aliasMiddleware('localeViewPath', LaravelLocalizationViewPath::class);
        Route::aliasMiddleware('localeSessionRedirect', LocaleSessionRedirect::class);
    }
}
