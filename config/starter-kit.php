<?php

return [
    'features' => [
        'auth' => [
            'registration' => '',
            '2fa' => [

            ],
            'socialite' => [

            ],
        ],
        'media' => [
            'enabled' => env('USES_MEDIA_LIBARY', true)
        ],
        'activity_log' => [
            'enabled' => env('USES_ACTIVTY_LOG', true)
        ],
        'settings' => [
            'enabled' => env('USES_SETTINGS', true)
        ],
    ],
];
