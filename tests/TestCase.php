<?php

namespace Code4Romania\Cms\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Orchestra\Testbench\BrowserKit\TestCase as BaseTestCase;
use Orchestra\Testbench\Concerns\WithLoadMigrationsFrom;

class TestCase extends BaseTestCase
{
    use RefreshDatabase, WithFaker, WithLoadMigrationsFrom;

    /** @var string */
    public $baseUrl = 'http://localhost';

    /** @var string */
    public $defaultLocale = 'en';

    protected function getPackageProviders($app)
    {
        return [
            'Code4Romania\Cms\CmsServiceProvider',
            'A17\Twill\TwillServiceProvider',
        ];
    }

    protected function getPackageAliases($app)
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
}
