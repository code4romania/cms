<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Front;

use Code4Romania\Cms\Helpers\SettingsHelper;
use Code4Romania\Cms\Helpers\UrlHelper;
use Code4Romania\Cms\Models\Page;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $item = Page::findOrFail(
            SettingsHelper::get('frontPage', 'site')
        );

        return view('front.pages.show')->withItem($item);
    }

    /**
     * Display the specified published resource that has an active translation.
     *
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        $item = Page::forSlug($slug)
            ->publishedInListings()
            ->withActiveTranslations()
            ->firstOrFail();

        return view('front.pages.show')->withItem($item);
    }

    /**
     * Preview the specified resource.
     *
     * @param string $slug
     * @return View
     */
    public function preview(string $slug): View
    {
        $item = Page::forSlug($slug)
            ->firstOrFail();

        return view('front.pages.show')->withItem($item);
    }
}
