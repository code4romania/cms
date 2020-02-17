<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Front;

use A17\Twill\Http\Controllers\Front\Controller as TwillFrontControler;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Controller extends TwillFrontControler
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function isPreview()
    {
        return Str::endsWith(Route::currentRouteName(), '.preview');
    }
}
