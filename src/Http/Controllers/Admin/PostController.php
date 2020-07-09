<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Admin;

class PostController extends ModuleController
{
    /** @var string */
    protected $moduleName = 'posts';

    /** @var string */
    protected $permalinkBase = 'blog';

    /** @var string */
    protected $previewView = 'front.posts.show';

    /** @var array<string> */
    protected $indexWith = [
        'translations',
    ];

    /** @var array<string> */
    protected $indexForm = [
        'translations',
    ];

    /** @var array */
    protected $indexColumns = [
        'title' => [
            'title' => 'Title',
            'field' => 'title',
            'sort'  => true,
        ],
        'publishDate' => [
            'title'   => 'Publish Date',
            'field'   => 'publishDate',
            'present' => true,
        ],
    ];
}
