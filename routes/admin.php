<?php

declare(strict_types=1);

if (Route::hasMacro('module')) {
    Route::module('pages');
    Route::module('menus');
    Route::module('partners');

    Route::prefix('blog')->group(static function (): void {
        Route::module('posts');
        Route::module('categories');
    });

    if (config('cms.enabled.people')) {
        Route::prefix('people')->group(static function (): void {
            Route::module('people');
            Route::module('cityLabs');
        });
    }

    Route::prefix('forms')->group(static function (): void {
        Route::module('forms');
        Route::module('responses');
    });
}
