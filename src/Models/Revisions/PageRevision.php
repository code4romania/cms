<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models\Revisions;

use A17\Twill\Models\Revision;

class PageRevision extends Revision
{
    /**
     * @var string
     */
    protected $table = "page_revisions";
}
