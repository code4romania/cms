<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Block;
use Code4Romania\Cms\Models\BaseModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

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
                return null;
                break;

            case 'external':
                return $item->input('target');
                break;

            case 'page':
                return self::getModelUrl('Page', 'front.pages.show', $item->input('target'));
                break;

            case 'category':
                return self::getModelUrl('Category', 'front.categories.show', $item->input('target'));
                break;
        }
    }

    public static function getModelUrl(string $modelName, string $routeName, $target): string
    {
        $item = app(config('twill.namespace') . '\\Models\\' . ucfirst($modelName))
            ->withActiveTranslations()
            ->find($target);

        return route($routeName, $item->slug);
    }
}
