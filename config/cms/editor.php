<?php

declare(strict_types=1);

return [

    'type'    => 'tiptap', // 'tiptap' or 'quill'
    'toolbar' => [
        ['header' => [2, 3, false]],
        'bold', 'italic', 'underline', 'strike', 'link', 'blockquote',
        'list',

        ['list' => 'ordered'],
        ['list' => 'bullet'],
        ['script' => 'sub'],
        ['script' => 'super'],
        ['align' => []],
        'table',
    ],

];
