<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Front;

use A17\Twill\Http\Controllers\Front\Controller as TwillFrontControler;
use Code4Romania\Cms\Traits\WithSeoTags;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class Controller extends TwillFrontControler
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, WithSeoTags;
}
