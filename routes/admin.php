<?php

declare(strict_types=1);

if (Route::hasMacro('module')) {
    Route::module('pages');
    Route::module('menus');
    Route::module('partners');

    if (config('cms.enabled.people')) {
        Route::prefix('people')->group(static function (): void {
            Route::module('people');
            Route::module('cityLabs');
        });
    }
}
