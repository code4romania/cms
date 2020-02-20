<?php

declare(strict_types=1);

use Code4Romania\Cms\Http\Controllers\Front\PageController;

Route::get('/', [PageController::class, 'index'])->name('pages.index');
Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');

Route::middleware(['web', 'twill_auth:twill_users', 'can:list'])->group(static function (): void {
    Route::get('/admin-preview/{slug}', [PageController::class, 'preview'])->name('pages.preview');
});
