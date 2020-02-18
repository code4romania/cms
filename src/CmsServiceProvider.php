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
     *
     * @var array<string>
     */
    protected $providers = [
        LocaleServiceProvider::class,
        RouteServiceProvider::class,
    ];

    /**
     * Register providers
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
        $this->publishAssets();
        $this->publishViews();
        $this->publishTranslations();

        $this->registerCommands();
        $this->registerRelationMorphMap();
    }

    /**
     * Merges the package configuration files into the given configuration namespaces.
     *
     * @return void
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
     *
     * @return void
     */
    private function publishConfigs(): void
    {
        $configs = [
            'blade-svg',
            'cms',
            'seotools',
            'twill',
            'twill-navigation',
            'twill/block_editor',
            'twill/dashboard',
            'twill/file_library',
            'twill/media_library',
            'translatable',
        ];

        foreach ($configs as $config) {
            $configSourcePath = __DIR__ . '/../config/' . $config . '.php';
            $configOutputPath = config_path($config . '.php');

            $this->publishes([
                $configSourcePath => $configOutputPath,
            ], 'config');
        }
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
            // 'applicationForm' => '\Models\ApplicationForm',
            // 'byproduct'       => '\Models\Byproduct',
            // 'domain'          => '\Models\Domain',
            'page'            => 'Code4Romania\Cms\Models\Page',
            // 'partner'         => '\Models\Partner',
            // 'financer'        => '\Models\Partner',
            // 'implementer'     => '\Models\Partner',
            // 'person'          => '\Models\Person',
            // 'post'            => '\Models\Post',
            // 'solution'        => '\Models\Solution',
        ]);
    }

    /**
     * Registers and publishes the package assets.
     *
     * @return void
     */
    private function publishAssets(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/svg' => resource_path('svg'),
        ], 'assets');
    }

    /**
     * Registers and publishes the package views.
     *
     * @return void
     */
    private function publishViews(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views'),
        ], 'views');
    }

    /**
     * Registers and publishes the package translations.
     *
     * @return void
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
