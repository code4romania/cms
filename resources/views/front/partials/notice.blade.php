@inject('settings', 'Code4Romania\Cms\Helpers\SettingsHelper')

@php
    $site = $settings->getSection('site');
    $enabled = boolval($site['notice_enabled'] ?? false);
    $content = $site['notice_content'] ?? null;

    if (isset($site['notice_color'])) {
        $color = config('cms.colors')[$site['notice_color']] ?? null;
    }

    $color ??= null;
@endphp

@if ($enabled)
    <x-notice :color="$color" :content="$content" />
@endif
