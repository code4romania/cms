<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Helpers;

use Code4Romania\Cms\Models\MenuItem;
use Code4Romania\Cms\Models\Page;

class MenuHelper
{
    public static function getItemsTree(string $menuLocation): array
    {
        // No known location, no items
        if (!in_array($menuLocation, config('cms.menu.locations'))) {
            return [];
        }

        $items = MenuItem::where('location', $menuLocation)
            ->with(['translations', 'children.translations'])
            ->ordered()
            ->get()
            ->toTree();

        return self::traverseTree($items);
    }

    protected static function traverseTree($items): array
    {
        $tree = [];

        foreach ($items as $item) {
            array_push($tree, [
                'type'     => $item->type,
                'label'    => $item->label,
                'url'      => self::getItemUrl($item),
                'children' => !$item->isLeaf() ? self::traverseTree($item->children) : [],
            ]);
        }

        return $tree;
    }

    public static function getItemUrl(MenuItem $item): ?string
    {
        switch ($item->type) {
            default:
                return null;
                break;

            case 'external':
                return $item->target;
                break;

            case 'page':
                $model = Page::find($item->target);
                $route = 'front.pages.show';
                break;
        }

        return !is_null($model) ? route($route, $model->slug) : null;
    }
}
