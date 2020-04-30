<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Front;

use Code4Romania\Cms\Helpers\SettingsHelper;
use Code4Romania\Cms\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $item = Page::findOrFail(
            SettingsHelper::get('frontPage', 'site')
        );

        return view('front.pages.show')->with([
            'item' => $item,
        ]);
    }

    public function show(string $slug): View
    {
        $item = Page::forSlug($slug)
            ->publishedInListings()
            ->withActiveTranslations()
            ->firstOrFail();

        return view('front.pages.show')->with([
            'item' => $item,
        ]);
    }

    public function preview(string $slug): View
    {
        $item = Page::forSlug($slug)
            ->firstOrFail();

        return view('front.pages.show')->with([
            'item' => $item,
        ]);
    }
}
