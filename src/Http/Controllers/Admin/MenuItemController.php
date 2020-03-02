<?php

namespace Code4Romania\Cms\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

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

    protected function indexData($request)
    {
        return [
            'nested' => true,
            'nestedDepth' => 1,
            'locationList'  => config('cms.menu_locations'),
        ];
    }

    protected function transformIndexItems($items)
    {
        return $items->toTree();
    }

    protected function indexItemData($item)
    {
        return ($item->children ? [
            'children' => $this->getIndexTableData($item->children),
        ] : []);
    }
}
