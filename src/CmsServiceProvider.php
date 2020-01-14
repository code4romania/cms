<?php

declare(strict_types=1);

namespace Code4Romania\Cms;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Service providers to be registered.
     *
     * @var string[]
     */
    protected $providers = [
        LocaleServiceProvider::class,
        RouteServiceProvider::class,
    ];

    /**
     * @var int
     */
    private $migrationsCounter = 0;

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigs();

        // Register providers
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishConfigs();
        $this->publishMigrations();
        $this->publishRoutes();

        $this->registerAndPublishViews();
        $this->registerAndPublishTranslations();
    }

    /**
     * Merges the package configuration files into the given configuration namespaces.
     *
     * @return void
     */
    private function mergeConfigs()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/cms.php', 'cms');
        $this->mergeConfigFrom(__DIR__ . '/../config/twill.php', 'twill');
        $this->mergeConfigFrom(__DIR__ . '/../config/twill-navigation.php', 'twill-navigation');
        $this->mergeConfigFrom(__DIR__ . '/../config/translatable.php', 'translatable');
    }

    /**
     * Defines the package configuration files for publishing.
     *
     * @return void
     */
    private function publishConfigs(): void
    {
        $configs = [
            'cms',
            'twill',
            'twill-navigation',
            'translatable',
        ];

        foreach ($configs as $config) {
            $configSourcePath = __DIR__ . '/../config/' . $config . '.php';
            $configOutputPath = config_path("{$config}.php");

            $this->publishes([
                $configSourcePath => $configOutputPath,
            ], 'config');
        }
    }

    /**
     * Defines the package routes files for publishing.
     *
     * @return void
     */
    private function publishRoutes(): void
    {
        $this->publishes([
            __DIR__ . '/../routes/admin.php' => base_path('routes/admin.php'),
            __DIR__ . '/../routes/web.php' => base_path('routes/web.php'),
        ], 'routes');
    }

    private function publishMigrations(): void
    {
        $migrations = [
            'CreatePagesTables',
        ];

        if ($this->app->runningInConsole()) {
            foreach ($migrations as $migration) {
                $this->publishMigration($migration);
            }
        }
    }

    /**
     * Based on twill's own publishMigration
     *
     * @see A17\Twill\TwillServiceProvider::publishMigration()
     *
     * @param string $migration
     * @return void
     */
    private function publishMigration(string $migration, ?string $publishKey = null): void
    {
        $files = new Filesystem();
        $this->migrationsCounter += 1;

        if (class_exists($migration)) {
            return;
        }

        // Verify that migration doesn't exist
        $migration_file = database_path(sprintf('database/migrations/*_%s.php', Str::snake($migration)));

        if (count($files->glob($migration_file))) {
            return;
        }

        $timestamp = date('Y_m_d_', time()) . (40000 + $this->migrationsCounter);
        $migrationSourcePath = sprintf('%s/../database/migrations/%s.php', __DIR__, Str::snake($migration));
        $migrationOutputPath = database_path(sprintf('migrations/%s_%s.php', $timestamp, Str::snake($migration)));

        $this->publishes([
            $migrationSourcePath => $migrationOutputPath,
        ], 'migrations');

        if ($publishKey) {
            $this->publishes([
                $migrationSourcePath => $migrationOutputPath,
            ], $publishKey);
        }
    }

    /**
     * Registers and publishes the package views.
     *
     * @return void
     */
    private function registerAndPublishViews()
    {
        $views = [
            'twill' => __DIR__ . '/../resources/views/admin',
            'cms' => __DIR__ . '/../resources/views/site',
        ];

        foreach ($views as $namespace => $viewPath) {
            $this->loadViewsFrom($viewPath, $namespace);
            $this->publishes([
                $viewPath => resource_path('views/vendor/' . $namespace)
            ], 'views');
        }
    }

    /**
     * Registers and publishes the package translations.
     *
     * @return void
     */
    private function registerAndPublishTranslations()
    {
        $translationPath = __DIR__ . '/../resources/lang';
        $this->loadTranslationsFrom($translationPath, 'cms');
        $this->publishes([$translationPath => resource_path('lang/vendor/cms')], 'translations');
    }
}
