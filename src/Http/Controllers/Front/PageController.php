<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Front;

use Code4Romania\Cms\Http\Controllers\Front\Controller;
use Code4Romania\Cms\Models\Page;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('cms::pages.show', [
            'item' => Page::first(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show(string $slug): View
    {
        $parts = explode('/', $slug, config('cms.nestedDepth'));

        // return $parts;

        return view('cms::pages.show', [
            'item' => Page::first(),
        ]);
    }
}
