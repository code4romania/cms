<?php

namespace Code4Romania\Cms\Http\Controllers\Admin;

use Illuminate\Support\Facades\Config;
use A17\Twill\Http\Controllers\Admin\ModuleController as TwillModuleController;

class ModuleController extends TwillModuleController
{
    /**
     * This overrides the default implementation, allowing us to directly add
     * the protocol to APP_URL
     *
     * Can be removed when the following issue gets solved.
     *
     * @see https://github.com/area17/twill/issues/555
     *
     * @return string
     */
    protected function getPermalinkBaseUrl()
    {
        return Config::get('app.url') . '/'
            . ($this->moduleHas('translations') ? '{language}/' : '')
            . ($this->moduleHas('revisions') ? '{preview}/' : '')
            . ($this->permalinkBase ?? $this->moduleName)
            . (isset($this->permalinkBase) && empty($this->permalinkBase) ? '' : '/');
    }
}
