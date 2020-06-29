<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Block;
use Code4Romania\Cms\Models\BaseModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Menu extends BaseModel
{
    use HasBlocks, HasTranslation;

    protected $fillable = [
        'published',
        'title',
        'description',
        'location',
    ];

    public $translatedAttributes = [
        'title',
        'active',
    ];

    public static function getLocation(string $menuLocation): array
    {
        // No known location, no items
        if (!in_array($menuLocation, config('cms.menu.locations'))) {
            return [];
        }

        return Cache::rememberForever('menu.' . $menuLocation, function () use ($menuLocation) {
            $menu = Menu::query()
                ->with('blocks')
                ->where('location', $menuLocation)
                ->publishedInListings()
                ->first();

            return self::buildTree($menu->blocks ?? collect());
        });
    }

    private static function buildTree(Collection $items): array
    {
        $parents = [];

        foreach ($items as $item) {
            $parents[(string) (int) $item->parent_id][] = [
                'id'        => $item->id,
                'parent_id' => $item->parent_id,
                'type'      => $item->input('type'),
                'label'     => $item->translatedInput('label'),
                'url'       => self::getItemUrl($item),
                'newtab'    => $item->checkbox('newtab'),
                'children'  => [],
            ];
        }

        return self::walk($parents[0] ?? [], $parents);
    }

    private static function walk($items, $parents)
    {
        foreach ($items as $position => $item) {
            $id = $item['id'];

            if (isset($parents[$id])) {
                $item['children'] = self::walk($parents[$id], $parents);
            }

            $items[$position] = $item;
        }

        return $items;
    }

    private static function getItemUrl(Block $item): ?string
    {
        switch ($item->input('type')) {
            default:
                return self::getModelUrl($item->input('type'), $item->input('target'));
                break;

            case 'external':
                return $item->input('target');
                break;

            case 'blog':
                return route('front.posts.index');
                break;
        }
    }

    public static function getModelUrl(string $modelName, $target, ?string $routeName = null): ?string
    {
        try {
            $item = app('Code4Romania\Cms\Models\\' . ucfirst($modelName))
                ->withActiveTranslations()
                ->find($target);

            if (is_null($routeName)) {
                $routeName = 'front.' . Str::plural($modelName) . '.show';
            }

            return route(
                $routeName ?? 'front.' . Str::plural($modelName) . '.show',
                $item->slug
            );
        } catch (BindingResolutionException $e) {
            return null;
        }
    }
}
