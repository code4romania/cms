<?php

namespace Code4Romania\Cms;

use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Service providers to be registered.
     *
     * @var string[]
     */
    protected $providers = [
        //
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}
