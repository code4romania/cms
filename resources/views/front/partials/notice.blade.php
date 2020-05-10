@inject('settings', 'Code4Romania\Cms\Helpers\SettingsHelper')

@php
    $site = $settings->getSection('site');
    $color = config('cms.colors')[$site['notice_color']] ?? null;
@endphp

@if (boolval($site['notice_enabled']))
    <x-notice :color="$color" :content="$site['notice_content']" />
@endif
