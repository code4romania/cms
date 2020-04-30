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
     * Merges the package configuration files into the given configuration namespaces.
     */
    private function mergeConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/cms.php', 'cms');
        $this->mergeConfigFrom(__DIR__ . '/../config/translatable.php', 'translatable');
        $this->mergeConfigFrom(__DIR__ . '/../config/twill.php', 'twill');
        $this->mergeConfigFrom(__DIR__ . '/../config/twill/block_editor.php', 'twill.block_editor');
        $this->mergeConfigFrom(__DIR__ . '/../config/twill/dashboard.php', 'twill.dashboard');
        $this->mergeConfigFrom(__DIR__ . '/../config/twill/file_library.php', 'twill.file_library');
        $this->mergeConfigFrom(__DIR__ . '/../config/twill/media_library.php', 'twill.media_library');
    }

    /**
     * Defines the package configuration files for publishing.
     */
    private function publishConfigs(): void
    {
        $this->publishes([
            __DIR__ . '/../.gitignore.dist' => app()->basePath('.gitignore'),
            __DIR__ . '/../.env.example' => app()->basePath('.env.example'),
        ], 'config');

        collect(self::$configFiles)
            ->each(function ($fileName): void {
                $configSourcePath = __DIR__ . '/../config/' . $fileName;
                $configOutputPath = config_path($fileName);

                $this->publishes([
                    $configSourcePath => $configOutputPath,
                ], 'config');
            });
    }

    private function publishMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
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
            'page'               => 'Code4Romania\Cms\Models\Page',
            'menu'               => 'Code4Romania\Cms\Models\Menu',
            // 'partner'         => '\Models\Partner',
            // 'financer'        => '\Models\Partner',
            // 'implementer'     => '\Models\Partner',
            // 'person'          => '\Models\Person',
            // 'post'            => '\Models\Post',
            // 'solution'        => '\Models\Solution',
        ]);
    }

    /**
     * Publishes the package resources.
     */
    private function publishResources(): void
    {
        $this->publishes([
            __DIR__ . '/../resources' => resource_path(),
        ], 'resources');
    }

    /**
     * Publishes the package assets.
     */
    private function publishAssets(): void
    {

        collect(self::$assetFiles)
            ->each(function ($fileName): void {
                $sourcePath = __DIR__ . '/../' . $fileName;
                $outputPath = app()->basePath($fileName);

                $this->publishes([
                    $sourcePath => $outputPath,
                ], 'assets');
            });
    }

    /**
     * Registers and publishes the package translations.
     */
    private function publishTranslations(): void
    {
        $translationPath = __DIR__ . '/../resources/lang';

        $this->loadTranslationsFrom($translationPath, 'cms');
        $this->publishes([
            $translationPath => resource_path('lang')
        ], 'translations');
    }
}
