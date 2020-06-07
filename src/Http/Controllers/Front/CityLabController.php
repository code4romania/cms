<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Front;

use Code4Romania\Cms\Helpers\SettingsHelper;
use Code4Romania\Cms\Models\CityLab;
use Illuminate\View\View;

class CityLabController extends Controller
{
    public function index(): View
    {
        $items = CityLab::publishedInListings()
            ->withActiveTranslations()
            ->get();

        $this->seo([
            'title'       => SettingsHelper::get('cityLabsTitle', 'seo'),
            'description' => SettingsHelper::get('cityLabsDescription', 'seo'),
            'routeName'   => 'front.cityLabs.index',
        ]);

        return view('front.cityLabs.index')->with([
            'items' => $items,
        ]);
    }

    public function show(string $slug): View
    {
        $item = CityLab::forSlug($slug)
            ->publishedInListings()
            ->with([
                'people' => function ($query) {
                    $query
                        ->publishedInListings()
                        ->orderBy('people.name', 'asc');
                }
            ])
            ->firstOrFail();

        $this->seo([
            'title'       => $item->name,
            'description' => $item->description,
            'routeName'   => 'front.cityLabs.show',
            'routeArg'    => 'slug',
            'slug'        => $slug,
        ]);

        return view('front.cityLabs.show')->with([
            'item' => $item,
        ]);
    }

    public function preview(string $slug): View
    {
        $item = CityLab::forSlug($slug)
            ->firstOrFail();

        $this->seo([
            'title'       => $item->title,
            'description' => $item->description,
        ]);

        return view('front.cityLabs.show')->with([
            'item' => $item,
        ]);
    }
}
