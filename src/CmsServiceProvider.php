<?php

declare(strict_types=1);

namespace Code4Romania\Cms;

use Code4Romania\Cms\Commands\Install;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Service providers to be registered.
     */
    protected array $providers = [
        LocaleServiceProvider::class,
        RouteServiceProvider::class,
    ];

    public static array $configFiles = [
        'blade-svg.php',
        'cms.php',
        'deploy.php',
        'seotools.php',
        'twill.php',
        'twill-navigation.php',
        'twill/block_editor.php',
        'twill/dashboard.php',
        'twill/file_library.php',
        'twill/media_library.php',
        'translatable.php',
    ];

    public static array $assetFiles = [
        'deploy/assets.php',
        'package.json',
        'tailwind.config.js',
        'webpack.mix.js',
    ];

    /**
     * Register providers
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
     */
    public function boot(): void
    {
        $this->publishConfigs();
        $this->publishMigrations();
        $this->publishTranslations();
        $this->publishResources();
        $this->publishAssets();

        $this->registerCommands();
        $this->registerRelationMorphMap();
    }

    /**
     * Returns path relative to the packages base directory
     *
     * @param string $path
     * @return null|string
     */
    private function packagePath(string $path = ''): ?string
    {
        return realpath(__DIR__ . '/../' . ltrim($path, '/')) ?: null;
    }

    /**
     * Merges the package configuration files into the given configuration namespaces.
     */
    private function mergeConfigs(): void
    {
        $configs = [
            'cms' => 'cms',
            'translatable' => 'translatable',
            'twill' => 'twill',
            'twill/block_editor' => 'twill.block_editor',
            'twill/dashboard' => 'twill.dashboard',
            'twill/file_library' => 'twill.file_library',
            'twill/media_library' => 'twill.media_library',
        ];

        foreach ($configs as $path => $key) {
            $this->mergeConfigFrom($this->packagePath("config/{$path}.php"), $key);
        }
    }

    /**
     * Defines the package configuration files for publishing.
     */
    private function publishConfigs(): void
    {
        $this->publishes([
            $this->packagePath('.gitignore.dist') => base_path('.gitignore'),
            $this->packagePath('.env.example') => base_path('.env.example'),
        ], 'config');

        collect(self::$configFiles)
            ->each(function ($fileName): void {
                $this->publishes([
                    $this->packagePath('config/' . $fileName) => config_path($fileName),
                ], 'config');
            });
    }

    private function publishMigrations(): void
    {
        $this->loadMigrationsFrom(
            $this->packagePath('database/migrations')
        );

        $this->publishes([
            $this->packagePath('database/migrations') => database_path('migrations'),
        ], 'migrations');
    }

    protected function registerCommands(): void
    {
        $this->commands([
            Install::class,
        ]);
    }

    protected function registerRelationMorphMap(): void
    {
        Relation::morphMap([
            'page' => 'Code4Romania\Cms\Models\Page',
            'menu' => 'Code4Romania\Cms\Models\Menu',
        ]);
    }

    /**
     * Publishes the package resources.
     */
    private function publishResources(): void
    {
        $this->publishes([
            $this->packagePath('resources') => resource_path(),
        ], 'resources');
    }

    /**
     * Publishes the package assets.
     */
    private function publishAssets(): void
    {

        collect(self::$assetFiles)
            ->each(function ($fileName): void {
                $this->publishes([
                    $this->packagePath($fileName) => base_path($fileName),
                ], 'assets');
            });
    }

    /**
     * Registers and publishes the package translations.
     */
    private function publishTranslations(): void
    {
        $translationPath = $this->packagePath('resources/lang');

        $this->loadTranslationsFrom($translationPath, 'cms');
        $this->publishes([
            $translationPath => resource_path('lang')
        ], 'translations');
    }
}
