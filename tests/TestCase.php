<?php

namespace Code4Romania\Cms\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\BrowserKit\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * @var string
     */
    public $baseUrl = 'http://localhost';

    protected function getPackageProviders($app)
    {
        return [
            'Code4Romania\Cms\CmsServiceProvider',
        ];
    }
}
