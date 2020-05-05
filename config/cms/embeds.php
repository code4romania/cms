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

];
