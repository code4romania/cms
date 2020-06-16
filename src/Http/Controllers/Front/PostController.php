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
            ->publishedInListings()
            ->get();

        $this->seo([
            'title'       => SettingsHelper::get('blogTitle', 'seo'),
            'description' => SettingsHelper::get('blogDescription', 'seo'),
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
