<?php

declare(strict_types=1);

if (Route::hasMacro('module')) {
    Route::module('pages');

    Route::module('menuItems');
}
