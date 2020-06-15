<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Http\Controllers\Admin;

class ResponseController extends ModuleController
{
    protected $moduleName = 'responses';

    /** @var array<string> */
    protected $indexOptions = [
        'create'          => false,
        'edit'            => true,
        'publish'         => false,
        'bulkPublish'     => false,
        'feature'         => false,
        'bulkFeature'     => false,
        'restore'         => true,
        'bulkRestore'     => true,
        'delete'          => true,
        'bulkDelete'      => true,
        'reorder'         => false,
        'permalink'       => false,
        'bulkEdit'        => true,
        'editInModal'     => false,
        'forceDelete'     => true,
        'bulkForceDelete' => true,
    ];

    /** @var array */
    protected $indexColumns = [
        'title' => [
            'title' => 'Title',
            'field' => 'title',
            'sort'  => true,
        ],
        'form' => [
            'title'   => 'Form',
            'field'   => 'form',
            'present' => true,
        ],
        'date' => [
            'title'   => 'Date',
            'field'   => 'created_at',
            'sort'    => true,
            'present' => true,
        ],
    ];
}
