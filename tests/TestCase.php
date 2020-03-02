<?php

namespace Code4Romania\Cms\Tests;

use A17\Twill\RouteServiceProvider;
use A17\Twill\TwillServiceProvider;
use Code4Romania\Cms\CmsServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Kalnoy\Nestedset\NestedSetServiceProvider;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Orchestra\Testbench\BrowserKit\TestCase as BaseTestCase;
use Orchestra\Testbench\Concerns\WithLoadMigrationsFrom;

class TestCase extends BaseTestCase
{
    use RefreshDatabase, WithFaker, WithLoadMigrationsFrom;

    /** @var string */
    public $baseUrl = 'http://localhost';

    protected function getPackageProviders($app): array
    {
        return [
            RouteServiceProvider::class,
            CmsServiceProvider::class,
            TwillServiceProvider::class,
            NestedSetServiceProvider::class,
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
}
