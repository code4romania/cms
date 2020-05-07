<?php

declare(strict_types=1);

use Code4Romania\Cms\Http\Controllers\Front\CityLabController;
use Code4Romania\Cms\Http\Controllers\Front\PageController;

Route::middleware(['web', 'twill_auth:twill_users', 'can:list'])->group(static function (): void {
    Route::get('/admin-preview/city-labs/{slug}', [CityLabController::class, 'preview'])->name('cityLabs.preview');
    Route::get('/admin-preview/{slug}', [PageController::class, 'preview'])->name('pages.preview');
});

Route::get('/city-labs', [CityLabController::class, 'index'])->name('cityLabs.index');
Route::get('/city-labs/{slug}', [CityLabController::class, 'show'])->name('cityLabs.show');

Route::get('/', [PageController::class, 'index'])->name('pages.index');
Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');
