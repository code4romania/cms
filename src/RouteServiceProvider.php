<?php

declare(strict_types=1);

namespace Code4Romania\Cms;

use Code4Romania\Cms\Http\Middleware\RedirectTrailingSlash;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'Code4Romania\Cms\Http\Controllers';

    /**
     * Bootstraps the package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRouteMiddlewares($this->app->get('router'));

        parent::boot();
    }

    /**
     * Register Route middleware.
     *
     * @param Router $router
     * @return void
     */
    private function registerRouteMiddlewares(Router $router)
    {
        Route::aliasMiddleware('redirectTrailingSlash', RedirectTrailingSlash::class);
    }


    /**
     * @return void
     */
    public function map(): void
    {
        $this->registerAdminRoutes(base_path('routes/admin.php'));
        $this->registerAdminRoutes(__DIR__ . '/../routes/admin.php');

        $this->registerFrontRoutes(base_path('routes/web.php'));
        $this->registerFrontRoutes(__DIR__ . '/../routes/web.php');
    }

    /**
     * @param string $routeFile
     * @return void
     */
    protected function registerAdminRoutes(string $routeFile): void
    {
        if (!file_exists($routeFile)) {
            return;
        }

        Route::group([
            'namespace' => $this->namespace . '\Admin',
            'domain' => config('twill.admin_app_url'),
            'as' => 'admin.',
            'middleware' => [
                config('twill.admin_middleware_group', 'web'),
                'twill_auth:twill_users',
                'impersonate',
                'validateBackHistory'
            ],
            'prefix' => trim(config('twill.admin_app_path', ''), '/'),
        ], function () use ($routeFile) {
            require_once($routeFile);
        });
    }

    /**
     * @param string $routeFile
     * @return void
     */
    protected function registerFrontRoutes(string $routeFile): void
    {
        if (!file_exists($routeFile)) {
            return;
        }

        Route::group([
            'namespace' => $this->namespace . '\Front',
            'domain' => config('app.url'),
            'as' => 'front.',
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [
                config('twill.admin_middleware_group', 'web'),
                'redirectTrailingSlash',
                'localeRedirectFilter',
                'localeViewPath',
                'localeSessionRedirect',
            ],
        ], function () use ($routeFile) {
            require_once($routeFile);
        });
    }
}