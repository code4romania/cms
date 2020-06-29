<?php

declare(strict_types=1);

use Code4Romania\Cms\Http\Controllers\Front\CategoryController;
use Code4Romania\Cms\Http\Controllers\Front\CityLabController;
use Code4Romania\Cms\Http\Controllers\Front\FormController;
use Code4Romania\Cms\Http\Controllers\Front\NewsletterSubscriptionController;
use Code4Romania\Cms\Http\Controllers\Front\PageController;
use Code4Romania\Cms\Http\Controllers\Front\PostController;

Route::middleware(['web', 'twill_auth:twill_users', 'can:list'])->group(static function (): void {
    Route::get('/admin-preview/city-labs/{slug}', [CityLabController::class, 'preview'])->name('cityLabs.preview');
    Route::get('/admin-preview/blog/{slug}', [PostController::class, 'preview'])->name('posts.preview');
    Route::get('/admin-preview/{slug}', [PageController::class, 'preview'])->name('pages.preview');
});

Route::prefix('/city-labs')->group(static function (): void {
    Route::get('/', [CityLabController::class, 'index'])->name('cityLabs.index');
    Route::get('/{slug}', [CityLabController::class, 'show'])->name('cityLabs.show');
});

Route::prefix('/blog')->group(static function (): void {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/{slug}', [PostController::class, 'show'])->name('posts.show');
});


Route::post('/form/{id}', [FormController::class, 'submit'])->name('form.submit')
    ->middleware('throttle:10,1');

Route::post('/newsletter', [NewsletterSubscriptionController::class, 'subscribe'])->name('newsletter.subscribe')
    ->middleware('throttle:10,1');

Route::get('/', [PageController::class, 'index'])->name('pages.index');
Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');
