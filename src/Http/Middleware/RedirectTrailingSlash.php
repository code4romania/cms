<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectTrailingSlash
{
    /**
     * Redirects to non-trailing slash page
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (preg_match('/.+\/$/', $request->getRequestUri())) {
            return redirect(rtrim($request->getRequestUri(), '/'), 301);
        }

        return $next($request);
    }
}
