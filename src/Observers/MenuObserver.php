<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Observers;

use Code4Romania\Cms\Models\Menu;
use Illuminate\Support\Facades\Cache;

class MenuObserver
{

    private function clearMenuLocationCache(Menu $menu): bool
    {
        return Cache::forget('menu.' . $menu->location);
    }

    /**
     * Handle the setting "created" event.
     */
    public function created(Menu $menu): void
    {
        $this->clearMenuLocationCache($menu);
    }

    /**
     * Handle the setting "updated" event.
     */
    public function updated(Menu $menu): void
    {
        $this->clearMenuLocationCache($menu);
    }

    /**
     * Handle the setting "deleted" event.
     */
    public function deleted(Menu $menu): void
    {
        $this->clearMenuLocationCache($menu);
    }

    /**
     * Handle the setting "restored" event.
     */
    public function restored(Menu $menu): void
    {
        $this->clearMenuLocationCache($menu);
    }

    /**
     * Handle the setting "force deleted" event.
     */
    public function forceDeleted(Menu $menu): void
    {
        $this->clearMenuLocationCache($menu);
    }
}
