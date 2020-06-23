<?php

declare(strict_types=1);

return [

    // The time to store a cached embed for (in seconds).
    'expiry' => 60 * 60 * 24 * 30,

    'args' => [
        // When set to true, this chooses the bigger image as the main image
        // instead the first found, that usually is the most relevant.
        'choose_bigger_image' => true,
    ],

    // This should match the aspect raio values defined in tailwind.config.js
    'aspectRatio' => [
        '1/1' => 1 / 1,
        '5/4' => 5 / 4,
        '4/3' => 4 / 3,
        '3/2' => 3 / 2,
        '5/3' => 5 / 3,
        '16/9' => 16 / 9,
        '2/1' => 2 / 1,
        '3/1' => 3 / 1,
        '5/6' => 5 / 6,
        '4/5' => 4 / 5,
        '3/4' => 3 / 4,
        '2/3' => 2 / 3,
        '3/5' => 3 / 5,
        '9/16' => 9 / 16,
        '1/2' => 1 / 2,
        '1/3' => 1 / 3,
    ],

];
