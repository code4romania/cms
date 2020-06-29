<?php

declare(strict_types=1);

namespace Code4Romania\Cms;

use Code4Romania\Cms\Commands\Install;
use Code4Romania\Cms\Helpers\SettingsHelper;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Service providers to be registered.
     *
     * @var array
     */
    protected $providers = [
        LocaleServiceProvider::class,
        RouteServiceProvider::class,
        ObserverServiceProvider::class,
        FakerServiceProvider::class,
    ];

    /** @var array */
    public static $configFiles = [
        'blade-icons.php',
        'cms.php',
        'cms',
        'deploy.php',
        'seotools.php',
        'twill.php',
        'twill-navigation.php',
        'twill',
        'translatable.php',
    ];

    /** @var array */
    public static $assetFiles = [
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
        $this->publishResources();
        $this->publishAssets();

        $this->registerCommands();
        $this->registerRelationMorphMap();

        $this->setupMailchimpConfig();
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
            'cms/editor' => 'cms.editor',
            'cms/embeds' => 'cms.embeds',
            'cms/enabled' => 'cms.enabled',
            'cms/form' => 'cms.form',
            'cms/menu' => 'cms.menu',
            'cms/social' => 'cms.social',
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
            $this->packagePath('database/migrations/default')
        );

        $this->publishes([
            $this->packagePath('database/migrations/default') => database_path('migrations'),
        ], 'migrations');

        $this->publishOptionalMigration('people');
    }

    private function publishOptionalMigration(string $feature): void
    {
        $this->loadMigrationsFrom(
            $this->packagePath("database/migrations/{$feature}")
        );

        if (config("cms.enabled.{$feature}", false)) {
            $this->publishes([
                $this->packagePath("database/migrations/{$feature}") => database_path('migrations'),
            ], 'migrations');
        }
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
            'cityLab' => \Code4Romania\Cms\Models\CityLab::class,
            'form'    => \Code4Romania\Cms\Models\Form::class,
            'menu'    => \Code4Romania\Cms\Models\Menu::class,
            'page'    => \Code4Romania\Cms\Models\Page::class,
            'partner' => \Code4Romania\Cms\Models\Partner::class,
            'person'  => \Code4Romania\Cms\Models\Person::class,
            'post'    => \Code4Romania\Cms\Models\Post::class,
        ]);
    }

    protected function setupMailchimpConfig(): void
    {
        if (!Schema::hasTable('settings')) {
            return;
        }

        config([
            'mailchimp' => [
                'apikey' => SettingsHelper::get('apiKey', 'mailchimp'),
            ],
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
}
