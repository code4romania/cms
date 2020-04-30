<?php

namespace Code4Romania\Cms\Tests;

use A17\Twill\RouteServiceProvider;
use A17\Twill\TwillServiceProvider;
use Artesaos\SEOTools\Providers\SEOToolsServiceProvider;
use Code4Romania\Cms\CmsServiceProvider;
use Code4Romania\Cms\Repositories\PageRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
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
        self::tearDown();
        putenv(LaravelLocalization::ENV_ROUTE_KEY . '=' . $locale);
        self::setUp();
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

        $this->withFactories(__DIR__ . '/../database/factories');

        File::ensureDirectoryExists(public_path('assets/cms'), 0755, true);
        File::put(public_path('assets/cms/mix-manifest.json'), '{}');

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

    protected function createPage()
    {
        $locales = $this->getAvailableLocales();

        $attributes = collect([
            'published' => true,
            'languages' => $locales
                ->map(fn ($locale) => ['value' => $locale, 'active' => true, 'published' => true]),

            'title' => $locales
                ->mapWithKeys(fn ($locale) => [$locale => $this->faker->word]),

            'slug' => $locales
                ->mapWithKeys(fn ($locale) => [$locale => $this->faker->slug]),
        ])->toArray();

        return [
            'attributes' => $attributes,
            'model'      => app(PageRepository::class)->create($attributes),
        ];
    }
}
