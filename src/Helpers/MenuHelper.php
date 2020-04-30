<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Helpers;

use A17\Twill\Models\Block;
use Code4Romania\Cms\Models\Menu;
use Illuminate\Support\Collection;

class MenuHelper
{
    public static function getItemsTree(string $menuLocation): array
    {
        // No known location, no items
        if (!in_array($menuLocation, config('cms.menu.locations'))) {
            return [];
        }

        $menu = Menu::with('blocks')
            ->where('location', $menuLocation)
            ->publishedInListings()
            ->first();

        return self::buildTree($menu->blocks ?? collect());
    }

    public static function buildTree(Collection $items): array
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

    protected static function walk($items, $parents)
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

    public static function getItemUrl(Block $item): ?string
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
        }
    }

    public static function getModelUrl(string $modelName, string $routeName, $target): string
    {
        $item = app(config('twill.namespace') . '\\Models\\' . ucfirst($modelName))
            ->publishedInListings()
            ->withActiveTranslations()
            ->find($target);

        return route($routeName, $item->slug);
    }
}
