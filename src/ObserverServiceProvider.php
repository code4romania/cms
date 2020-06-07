<?php


declare(strict_types=1);

namespace Code4Romania\Cms;

use A17\Twill\Models\Translations\SettingTranslation;
use Code4Romania\Cms\Models\Menu;
use Code4Romania\Cms\Observers\MenuObserver;
use Code4Romania\Cms\Observers\SettingTranslationObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
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
        SettingTranslation::observe(SettingTranslationObserver::class);
        Menu::observe(MenuObserver::class);
    }
}
