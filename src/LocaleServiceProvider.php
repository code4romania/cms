<?php

declare(strict_types=1);

namespace Code4Romania\Cms;

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
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
    public function boot()
    {
        $this->registerRouteMiddlewares($this->app->get('router'));
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
     * @return void
     */
    public function setupLocalizationConfig(): void
    {
        $config = [
            'useAcceptLanguageHeader' => false,
            'hideDefaultLocaleInURL' => false,
            'supportedLocales' => [],
            'localesOrder' => config('translatable.locales'),
        ];

        foreach (config('translatable.languages') as $locale => $name) {
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
     * @param Router $router
     * @return void
     */
    private function registerRouteMiddlewares(Router $router)
    {
        Route::aliasMiddleware('localeRedirectFilter', LaravelLocalizationRedirectFilter::class);
        Route::aliasMiddleware('localeViewPath', LaravelLocalizationViewPath::class);
        Route::aliasMiddleware('localeSessionRedirect', LocaleSessionRedirect::class);
    }
}
