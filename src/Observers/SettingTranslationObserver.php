<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Observers;

use A17\Twill\Models\Setting;
use A17\Twill\Models\Translations\SettingTranslation;
use Illuminate\Support\Facades\Cache;

class SettingTranslationObserver
{
    private function clearSettingSectionCache(SettingTranslation $settingTranslation): bool
    {
        return Cache::forget('settings.' . Setting::find($settingTranslation->setting_id)->section);
    }

    /**
     * Handle the setting "created" event.
     */
    public function created(SettingTranslation $settingTranslation): void
    {
        $this->clearSettingSectionCache($settingTranslation);
    }

    /**
     * Handle the setting "updated" event.
     */
    public function updated(SettingTranslation $settingTranslation): void
    {
        $this->clearSettingSectionCache($settingTranslation);
    }

    /**
     * Handle the setting "deleted" event.
     */
    public function deleted(SettingTranslation $settingTranslation): void
    {
        $this->clearSettingSectionCache($settingTranslation);
    }

    /**
     * Handle the setting "restored" event.
     */
    public function restored(SettingTranslation $settingTranslation): void
    {
        $this->clearSettingSectionCache($settingTranslation);
    }

    /**
     * Handle the setting "force deleted" event.
     */
    public function forceDeleted(SettingTranslation $settingTranslation): void
    {
        $this->clearSettingSectionCache($settingTranslation);
    }
}
