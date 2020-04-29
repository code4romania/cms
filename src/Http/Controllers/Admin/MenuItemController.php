<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use Illuminate\Support\Collection;

class MenuItemController extends ModuleController
{
    protected $moduleName = 'menuItems';

    protected $titleColumnKey = 'label';

    protected $indexOptions = [
        'publish'     => false,
        'permalink'   => false,
        'editInModal' => false,
        'reorder'     => true,
    ];

    protected $indexColumns = [
        'label' => [
            'title' => 'Label',
            'field' => 'label',
            'sort' => true,
        ],
        'location' => [
            'title' => 'Location',
            'field' => 'location',
            'sort' => true,
        ],
    ];

    protected $filters = [
        'location'  => 'location',
    ];

    protected function indexData($request): array
    {
        return [
            'nested' => true,
            'nestedDepth' => 1,
            'locationList'  => config('cms.menu.locations'),
        ];
    }

    protected function transformIndexItems($items): Collection
    {
        return $items->toTree();
    }

    protected function indexItemData($item): array
    {
        if (!$item->children) {
            return [];
        }

        return [
            'children' => $this->getIndexTableData($item->children),
        ];
    }
}
