<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Front;

use Code4Romania\Cms\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('front.posts.index');
    }

    public function show(string $slug): View
    {
        $item = Category::query()
            ->forSlug($slug)
            ->firstOrFail();

        $this->seo([
            'title'       => $item->title,
            'description' => $item->description,
            'routeName'   => 'front.categories.show',
            'routeArg'    => 'slug',
            'slug'        => $slug,
        ]);

        return view('front.categories.show')->with([
            'item' => $item,
        ]);
    }
}
