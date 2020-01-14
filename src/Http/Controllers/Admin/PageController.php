<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use A17\Twill\Http\Requests\Admin\Request;
use Illuminate\Database\Eloquent\Collection;

class PageController extends ModuleController
{
    /**
     * @var string
     */
    protected $moduleName = 'pages';

    /**
     * @var string
     */
    protected $permalinkBase = '';

    /**
     * @var string
     */
    protected $previewView = 'cms::pages.show';

    /**
     * Options of the index view.
     *
     * @var array<string|bool>
     */
    protected $indexOptions = [
        'reorder' => true,
    ];

    /**
     * @param Request $request
     * @return array<string|bool|int>
     */
    protected function indexData($request): array
    {
        return [
            'nested' => false,
            // this should control the allowed depth in UI
            // but doesn't seem to actually do anything
            'nestedDepth' => config('cms.nestedDepth', 2),
        ];
    }

    /**
     * @param Collection $items
     * @return Collection
     */
    protected function transformIndexItems($items): Collection
    {
        return $items->toTree();
    }

    /**
     * @param \A17\Twill\Models\Model $item
     * @return array<string, array>
     */
    protected function indexItemData($item): array
    {
        if (!isset($item->children) || !$item->children) {
            return [];
        }

        return [
            'children' => $this->getIndexTableData($item->children),
        ];
    }

    /**
     * @param array<string> $scopes
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getBrowserItems($scopes = []): Collection
    {
        return $this->repository->get(
            $this->indexWith,
            $scopes,
            $this->orderScope(),
            request('offset') ?? $this->perPage ?? 50,
            true
        );
    }
}
