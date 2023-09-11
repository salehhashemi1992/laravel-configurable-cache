# Laravel Customized Cache Manager
With this Class you can access laravel main cache facade with you configurations like cache prefix and cache ttl duration.

You can change these configurations in your cache.php config file:

    'configs' => [
        'default' => [
            'prefix' => '_default_',
            'duration' => '+1 Year',
        ],
        'tiny' => [
            'prefix' => '_tiny_',
            'duration' => '+15 minutes',
        ],
        'short' => [
            'prefix' => '_short_',
            'duration' => '+1 hour',
        ],
        'otp' => [
            'prefix' => '_otp_',
            'duration' => '+3 minutes',
        ],
    ]
