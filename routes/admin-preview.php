<?php

declare(strict_types=1);

if (Route::hasMacro('moduleShowWithPreview')) {
    Route::moduleShowWithPreview('pages', '', 'Page');
}
