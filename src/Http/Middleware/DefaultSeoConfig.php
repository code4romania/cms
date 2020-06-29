<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Middleware;

use Closure;
use Code4Romania\Cms\Helpers\SettingsHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DefaultSeoConfig
{
    /**
     * Redirects to non-trailing slash page
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $seo = SettingsHelper::getSection('site');

        if ('' !== ($title = strip_tags($seo['siteTitle'] ?? ''))) {
            Config::set([
                'seotools.meta.defaults.title'          => $title,
                'seotools.opengraph.defaults.title'     => $title,
                'seotools.opengraph.defaults.site_name' => $title,
                'seotools.json-ld.defaults.title'       => $title,
            ]);
        }

        if ('' !== ($description = strip_tags($seo['siteDescription'] ?? ''))) {
            Config::set([
                'seotools.meta.defaults.description'      => $description,
                'seotools.opengraph.defaults.description' => $description,
                'seotools.json-ld.defaults.description'   => $description,
            ]);
        }

        return $next($request);
    }
}
