<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Tests;

use A17\Twill\RouteServiceProvider;
use A17\Twill\TwillServiceProvider;
use Artesaos\SEOTools\Providers\SEOToolsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Code4Romania\Cms\CmsServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Kalnoy\Nestedset\NestedSetServiceProvider;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Orchestra\Testbench\BrowserKit\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use RefreshDatabase, WithFaker;

    /** @var string */
    public $baseUrl = 'http://localhost';

    protected function getPackageProviders($app): array
    {
        return [
            RouteServiceProvider::class,
            CmsServiceProvider::class,
            TwillServiceProvider::class,
            NestedSetServiceProvider::class,
            SEOToolsServiceProvider::class,
            BladeIconsServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'laravellocalization' => LaravelLocalization::class,
        ];
    }

    protected function refreshApplicationWithLocale($locale): void
    {
        $this->tearDown();
        putenv(LaravelLocalization::ENV_ROUTE_KEY . '=' . $locale);
        $this->setUp();
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        putenv(LaravelLocalization::ENV_ROUTE_KEY . '=' . 'en');

        parent::setUp();
        Artisan::call('storage:link');

        $this->withFactories(__DIR__ . '/../database/factories');

        File::ensureDirectoryExists(public_path('assets/cms'), 0755, true);
        File::put(
            public_path('assets/cms/mix-manifest.json'),
            '{"/app.js":"/app.js","/app.css":"/app.css","/manifest.js":"/manifest.js","/vendor.js":"/vendor.js"}'
        );

        // Load views for testing
        View::addLocation(__DIR__ . '/../resources/views');
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        putenv(LaravelLocalization::ENV_ROUTE_KEY);
        parent::tearDown();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function resolveApplicationConfiguration($app)
    {
        parent::resolveApplicationConfiguration($app);

        $app['config']->set('blade-icons', [
            'sets' => [
                'default' => [
                    'path'   => '../../../../resources/assets/svg',
                    'prefix' => 'icon',
                    'class'  => 'fill-current',
                ],
            ],
        ]);
    }

    protected function getAvailableLocales(): Collection
    {
        return collect(config('translatable.locales', []));
    }

    protected function getLocalesExceptCurrent(): Collection
    {
        return $this
            ->getAvailableLocales()
            ->reject(fn ($locale) => $locale === app()->getLocale());
    }

    protected function isCurrentLocale(string $locale): bool
    {
        return $locale === app()->getLocale();
    }
}
