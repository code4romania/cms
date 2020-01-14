<?php

declare(strict_types=1);

Route::get('/', 'PageController@index')->name('pages.index');
Route::name('pages.show')->get('{slug}', 'PageController@show');


Route::group([
    'middleware' => ['web', 'twill_auth:twill_users', 'can:list'],
], static function (): void {
    Route::name('pages.preview')->get('/admin-preview/{slug}', 'PageController@show');
});
