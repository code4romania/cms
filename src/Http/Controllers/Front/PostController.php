<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Front;

use Code4Romania\Cms\Helpers\SettingsHelper;
use Code4Romania\Cms\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $items = Post::query()
            ->withActiveTranslations()
            ->with('medias')
            ->with(['slugs' => fn ($query) => $query->where('locale', app()->getLocale())])
            ->publishedInListings()
            ->orderByDesc('publish_start_date')
            ->paginate();

        abort_if($items->isEmpty(), 404);

        $this->seo([
            'title'       => SettingsHelper::get('blogTitle', 'site'),
            'description' => SettingsHelper::get('blogDescription', 'site'),
            'routeName'   => 'front.posts.index',
        ]);

        return view('front.posts.index')->with([
            'items' => $items,
        ]);
    }

    public function show(string $slug): View
    {
        $item = Post::query()
            ->forSlug($slug)
            ->publishedInListings()
            ->with('translation')
            ->firstOrFail();

        $this->seo([
            'title'       => $item->title,
            'description' => $item->description,
            'routeName'   => 'front.posts.show',
            'routeArg'    => 'slug',
            'slug'        => $slug,
        ]);

        return view('front.posts.show')->with([
            'item' => $item,
        ]);
    }

    public function preview(string $slug): View
    {
        $item = Post::query()
            ->forSlug($slug)
            ->firstOrFail();

        $this->seo([
            'title'       => $item->title,
            'description' => $item->description,
        ]);

        return view('front.posts.show')->with([
            'item' => $item,
        ]);
    }
}
