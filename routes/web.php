<?php

declare(strict_types=1);

Route::get('/', 'PageController@index')->name('pages.index');
Route::get('{path?}', 'PageController@show')->where('path', '.*')->name('pages.show');
